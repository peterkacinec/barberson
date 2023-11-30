<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Common\Infrastructure\Log\Context;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\CustomerUser;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        try {
            if(!Auth::attempt($request->validated())){
                return new JsonResponse(false, Response::HTTP_UNAUTHORIZED);
            }

            $customerUser = CustomerUser::where('email', $request->email)->first();

            return new JsonResponse([
                'status' => true,
                'token' => $customerUser->createToken(CustomerUser::ACCESS_TOKEN_NAME)->plainTextToken
            ], Response::HTTP_OK);

        } catch (Exception $exception) {
            Log::error(
                sprintf("Some error occurred while log in customer user, reason: %s", $exception->getMessage()),
                [
                    Context::MESSAGE_TYPE => self::class,
                    Context::EXCEPTION => $exception,
                ]
            );

            return new JsonResponse(false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
