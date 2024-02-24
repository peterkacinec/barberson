<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\Application\PasswordMissmatchException;
use App\Exceptions\ApplicationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\CustomerUser;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class UpdatePasswordController extends Controller
{
    public function __invoke(UpdatePasswordRequest $request): JsonResponse
    {
        try {
            $loggedUser = $request->user();

            if (!Hash::check($request->current_password, $loggedUser->password)) {
                throw new PasswordMissmatchException();
            }

            $loggedUser->forceFill(
                ['password' => Hash::make($request->password)]
            )->setRememberToken(Str::random(60)); //todo treba preverit

            $loggedUser->save();

            event(new PasswordReset($loggedUser));
        } catch (ApplicationException $exception) {
            return new JsonResponse(false, Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'token' => $loggedUser->createToken(CustomerUser::ACCESS_TOKEN_NAME)->plainTextToken
        ], Response::HTTP_OK);
    }
}
