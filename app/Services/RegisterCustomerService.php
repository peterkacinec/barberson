<?php

declare(strict_types=1);

namespace App\Services;

use App\Common\Application\TransactionServiceInterface;
use App\Models\Customer;
use App\Models\CustomerUser;

class RegisterCustomerService
{
    private CustomerUser $customerUser;

    public function __construct(private TransactionServiceInterface $transactionService)
    {
    }

    public function __invoke(array $request): ?CustomerUser
    {
        $this->transactionService->transactional(
            function () use ($request) {
                $this->customerUser = new CustomerUser($request);
                $this->customerUser->save();

                $customer = new Customer();
                $customer->user()->associate($this->customerUser);
                $customer->save();
            }
        );

        return $this->customerUser;
    }
}
