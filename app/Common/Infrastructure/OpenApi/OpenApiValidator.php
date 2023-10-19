<?php

namespace App\Common\Infrastructure\OpenApi;

use League\OpenAPIValidation\PSR7\Exception\NoOperation;
use League\OpenAPIValidation\PSR7\Exception\ValidationFailed;
use League\OpenAPIValidation\PSR7\OperationAddress;
use League\OpenAPIValidation\PSR7\ValidatorBuilder;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OpenApiValidator implements OpenApiValidatorInterface
{
    use OpenApiValidationFailedExceptionParser;

    private PsrHttpFactory $psrHttpFactory;
    private ValidatorBuilder $validatorBuilder;
    private string $yamlFile = '../doc/api.yaml'; // todo presunut do konfiguracie

    public function __construct(
//        string $pathToOpenApiSpec,
//        private LoggerInterface $logger, //todo rozbehat logger
    ) {
        $psr17Factory = new Psr17Factory();
        $this->psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);

        $this->validatorBuilder = (new ValidatorBuilder())->fromYamlFile($this->yamlFile);
    }

    public function validateRequest(Request $request): void
    {
        $psrRequest = $this->toPsrRequest($request);
        try {
            $this->validatePsrRequest($psrRequest);
        } catch (OpenApiValidatorException $exception) {
            //todo nastavit logovanie
//            $this->logger->error(
//                'Open API Validation failed!',
//                [
//                    Context::MESSAGE_TYPE => 'OpenApiValidator',
//                    Context::EXCEPTION => $exception,
//                    'path' => $request->getBasePath(),
//                ]
//            );

            throw $exception;
        }
    }

    public function validateResponse(Request $request, Response $response): void
    {
        $psrResponse = $this->toPsrResponse($response);
        $psrRequest = $this->toPsrRequest($request);

        try {
            $validatorBuilder = (new ValidatorBuilder())->fromYamlFile($this->yamlFile);

            $operation = new OperationAddress(
                $psrRequest->getUri()->getPath(),
                strtolower($psrRequest->getMethod())
            );

            $validatorBuilder
                ->getResponseValidator()
                ->validate($operation, $psrResponse);
        } catch (ValidationFailed $exception) {
            $validationFailedMessage = $this->getOpenAPIValidatorExceptionMessage($exception);

//            $this->logger->error(
//                'Open API Response Validation failed!',
//                [
//                    Context::MESSAGE_TYPE     => 'OpenAPIValidator',
//                    Context::EXCEPTION        => $e,
//                    'validationFailedMessage' => $validationFailedMessage,
//                    'responseBody'            => $psrResponse->getBody()->getContents(),
//                    'requestBody'             => $psrRequest->getBody()->getContents(),
//                ],
//            );

            throw new OpenAPIValidatorException($validationFailedMessage, $exception);
        }

    }

    private function validatePsrRequest(ServerRequestInterface $serverRequest): void
    {
        try {
            $this->validatorBuilder->getServerRequestValidator()->validate($serverRequest);
        } catch (ValidationFailed $exception) {
            $validationFailedMessage = $this->getOpenAPIValidatorExceptionMessage($exception);

            // todo mozno len docasny workaround pre EP ktore nemaju dokumentaciu
            if ($exception instanceof NoOperation) {
                return;
            }

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
