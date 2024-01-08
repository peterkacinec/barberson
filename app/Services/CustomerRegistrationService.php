<?php

declare(strict_types=1);

namespace App\Services;

use App\Common\Application\TransactionServiceInterface;
use App\Exceptions\Application\EmailAlreadyExistsException;
use App\Exceptions\Application\RegisterCustomerException;
use App\Models\Customer;
use App\Models\CustomerUser;

class CustomerRegistrationService
{
    private CustomerUser $customerUser;

    public function __construct(private TransactionServiceInterface $transactionService)
    {
    }

    public function __invoke(array $request): ?CustomerUser
    {
        $this->transactionService->transactional(
            function () use ($request) {
                if (CustomerUser::where('email', $request['email'])->first()) {
                    throw new EmailAlreadyExistsException(
                        "Duplicate email address. Try a new one or reset password"
                    );
                }

                $this->customerUser = new CustomerUser($request);
                $this->customerUser->save(); //must be here

                $customer = new Customer();
                $customer->user()->associate($this->customerUser);
                if (!$customer->isPerson() && !$customer->isCompany()) {
                    throw new RegisterCustomerException("Customer registration invalid data.");
                }
                $customer->save();
            }
        );

        return $this->customerUser;
    }
}
