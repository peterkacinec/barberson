<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Common\Infrastructure\Log\Context;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\CustomerUser;
use App\Services\RegisterCustomerService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function __construct(private RegisterCustomerService $registerCustomerService)
    {}

    public function __invoke(RegisterUserRequest $request): JsonResponse
    {
        try {
            $customerUser = $this->registerCustomerService->__invoke($request->validated());
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
