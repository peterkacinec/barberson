<?php

declare(strict_types=1);

namespace App\Services;

use App\Common\Application\TransactionServiceInterface;
use App\Models\Customer;
use App\Models\CustomerUser;

class SaveCustomerService
{
    public function __construct(private TransactionServiceInterface $transactionService)
    {
    }

    public function __invoke(array $request): void
    {
        $this->transactionService->transactional(
            function () use ($request) {
                $customerUser = new CustomerUser($request);
                $customerUser->save();

                $customer = new Customer();
                $customer->user()->associate($customerUser);
                $customer->save();
            }
        );
    }
}
