<?php

declare(strict_types=1);

namespace App\Common\Application;

interface PaymentGatewayInterface
{
    public function createPaymentIntent(array $requestData, string $customerEmail): array;
}
