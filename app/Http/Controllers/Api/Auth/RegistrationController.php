<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Common\Infrastructure\Log\Context;
use App\Exceptions\Application\EmailAlreadyExistsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\CustomerUser;
use App\Services\CustomerRegistrationService;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function __construct(private CustomerRegistrationService $customerRegistrationService)
    {}

    public function __invoke(RegisterUserRequest $request): JsonResponse
    {
        try {
            $customerUser = $this->customerRegistrationService->__invoke($request->validated());

            event(new Registered($customerUser));
        } catch (EmailAlreadyExistsException $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_CONFLICT);
        } catch (Exception $exception) {
            Log::error(
                sprintf("Some problem during the user registration, reason: %s", $exception->getMessage()),
                [
                    Context::MESSAGE_TYPE => self::class,
                    Context::EXCEPTION => $exception,
                ]
            );

            return new JsonResponse(false, Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'status' => true,
            'token' => $customerUser->createToken(CustomerUser::ACCESS_TOKEN_NAME)->plainTextToken
        ], Response::HTTP_OK);
    }
}
