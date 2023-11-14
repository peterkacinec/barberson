<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\CustomerUser;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function __invoke(RegisterUserRequest $request)
    {
        try {
            $request->validated();

            $user = CustomerUser::create([
                'first_name' => $request->first_name,
                'surname' => $request->surname,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
