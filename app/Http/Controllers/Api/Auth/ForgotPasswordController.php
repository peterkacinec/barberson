<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Models\CustomerUser;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;

class ForgotPasswordController extends Controller
{
    public function __invoke(ForgotPasswordRequest $request): JsonResponse
    {
        try {
            CustomerUser::where('email', $request->email)->firstOrFail();

            Password::sendResetLink($request->validated());
        } catch (Exception) {
            return new JsonResponse(false, Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(true, Response::HTTP_OK);
    }
}
