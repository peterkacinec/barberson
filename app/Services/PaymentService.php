<?php

declare(strict_types=1);

namespace App\Services;

use App\Common\Application\PaymentGatewayInterface;

class PaymentService
{
    public function __construct(private PaymentGatewayInterface $paymentGateway)
    {
    }

    public function __invoke(int $amount, string $token): void
    {
        $this->paymentGateway->charge($amount, $token);
    }
}
