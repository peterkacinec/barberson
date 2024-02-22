<?php

declare(strict_types=1);

namespace App\Services;

use App\Common\Application\TransactionServiceInterface;
use App\Exceptions\Application\InvalidTokenException;
use App\Exceptions\Application\ModelNotFoundException;
use App\Models\CustomerUser;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordService
{
    public function __construct(private TransactionServiceInterface $transactionService)
    {
    }

    public function __invoke(array $appRequest): void
    {
        $this->transactionService->transactional(
            function () use ($appRequest) {
                $state = Password::reset(
                    $appRequest,
                    function (CustomerUser $customerUser, string $password) {
                        $customerUser->forceFill([
                            'password' => Hash::make($password)
                        ])->setRememberToken(Str::random(60)); //todo preverit

                        $customerUser->save();

                        event(new PasswordReset($customerUser));
                    }
                );

                if ($state === Password::INVALID_USER) {
                    throw new ModelNotFoundException("Reset password, CustomerUser not found by email [{$appRequest['email']}]");
                }

                if ($state === Password::INVALID_TOKEN) {
                    throw new InvalidTokenException("Reset password token not found [{$appRequest['token']}]");
                }
            }
        );
    }
}
