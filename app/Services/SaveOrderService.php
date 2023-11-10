<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order;

class SaveOrderService
{
    public function __invoke(array $request): void
    {
        //todo doplnit transakciu
        $customerUser = new Order($request);
        $customerUser->save();
    }
}
