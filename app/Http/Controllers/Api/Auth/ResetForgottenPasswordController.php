<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\ApplicationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetForgottenPasswordRequest;
use App\Models\CustomerUser;
use App\Services\ResetPasswordService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResetForgottenPasswordController extends Controller
{
    public function __construct(
        private ResetPasswordService $resetPasswordService,
    ) {
    }

    public function __invoke(ResetForgottenPasswordRequest $request): JsonResponse
    {
        try {
            $this->resetPasswordService->__invoke($request->validated());
            $customerUser = CustomerUser::where('email', $request->email)->firstOrFail();
        } catch (ApplicationException $exception) {
            return new JsonResponse(false, Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'token' => $customerUser->createToken(CustomerUser::ACCESS_TOKEN_NAME)->plainTextToken
        ], Response::HTTP_OK);
    }
}
