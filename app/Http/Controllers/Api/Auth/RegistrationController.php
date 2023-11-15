<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Services\RegisterCustomerService;
use Illuminate\Http\JsonResponse;
use Throwable;

class RegistrationController extends Controller
{
    public function __construct(private RegisterCustomerService $registerCustomerService)
    {
    }

    public function __invoke(RegisterUserRequest $request): JsonResponse
    {
        try {
            $customerUser = $this->registerCustomerService->__invoke($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $customerUser->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
