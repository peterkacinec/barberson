<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\OpenApi;

use App\Common\Application\OpenApiValidatorInterface;
use App\Common\Infrastructure\Log\Context;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\OpenAPIValidation\PSR7\Exception\ValidationFailed;
use League\OpenAPIValidation\PSR7\OperationAddress;
use League\OpenAPIValidation\PSR7\ValidatorBuilder;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OpenApiValidator implements OpenApiValidatorInterface
{
    use OpenApiValidationFailedExceptionParser;

    private PsrHttpFactory $psrHttpFactory;
    private ValidatorBuilder $validatorBuilder;

    public function __construct(
        private string $pathToOpenApiSpec,
    ) {
        $psr17Factory = new Psr17Factory();
        $this->psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);

        $this->validatorBuilder = (new ValidatorBuilder())->fromYamlFile($this->pathToOpenApiSpec);
    }

    public function validateRequest(Request $request): void
    {
        $psrRequest = $this->toPsrRequest($request);
        try {
            $this->validatePsrRequest($psrRequest);
        } catch (OpenApiValidatorException $exception) {
            Log::error(
                'Open API Validation failed!',
                [
                    Context::MESSAGE_TYPE => 'OpenApiValidator',
                    Context::EXCEPTION => $exception,
                    'path' => $request->getBasePath(),
                ]
            );

            throw $exception;
        }
    }

    public function validateResponse(Request $request, JsonResponse $response): JsonResponse
    {
        $psrResponse = $this->toPsrResponse($response);
        $psrRequest = $this->toPsrRequest($request);

        try {
            $validatorBuilder = (new ValidatorBuilder())->fromYamlFile($this->pathToOpenApiSpec);

            $operation = new OperationAddress(
                $psrRequest->getUri()->getPath(),
                strtolower($psrRequest->getMethod())
            );

            $validatorBuilder
                ->getResponseValidator()
                ->validate($operation, $psrResponse);
        } catch (ValidationFailed $exception) {
            $validationFailedMessage = $this->getOpenAPIValidatorExceptionMessage($exception);

            Log::error(
                'Open API Response Validation failed!',
                [
                    Context::MESSAGE_TYPE => 'OpenAPIValidator',
                    Context::EXCEPTION => $exception,
                    'validationFailedMessage' => $validationFailedMessage,
                    'responseBody' => $psrResponse->getBody()->getContents(),
                    'requestBody' => $psrRequest->getBody()->getContents(),
                ],
            );

            throw new OpenAPIValidatorException($validationFailedMessage, $exception);
        }

        return $response;
    }

    private function validatePsrRequest(ServerRequestInterface $serverRequest): void
    {
        try {
            $this->validatorBuilder->getServerRequestValidator()->validate($serverRequest);
        } catch (ValidationFailed $exception) {
            $validationFailedMessage = $this->getOpenAPIValidatorExceptionMessage($exception);

            // todo mozno len docasny workaround pre EP ktore nemaju dokumentaciu
//            if ($exception instanceof NoOperation) {
//                return;
//            }

            throw new OpenApiValidatorException($validationFailedMessage, $exception);
        }
    }

    private function toPsrRequest(Request $request): ServerRequestInterface
    {
        return $this->psrHttpFactory->createRequest($request);
    }

    private function toPsrResponse(Response $response): ResponseInterface
    {
        return $this->psrHttpFactory->createResponse($response);
    }
}
