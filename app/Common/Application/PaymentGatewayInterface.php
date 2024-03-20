<?php

declare(strict_types=1);

namespace App\Common\Application;

use Illuminate\Http\Request;

interface PaymentGatewayInterface
{
    public function createPaymentIntent(int $amount, string $currency, string $description, string $customerEmail): array;
}
