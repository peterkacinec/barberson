<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Customer;
use App\Models\CustomerUser;

class SaveCustomerService
{
    public function __invoke(array $request): void
    {
        //todo doplnit transakciu
        $customerUser = new CustomerUser($request);
        $customerUser->save();

        $customer = new Customer();
        $customer->user()->associate($customerUser);
        $customer->save();
    }
}
