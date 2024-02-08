<?php

declare(strict_types=1);

namespace App\Common\Application;

interface PaymentGatewayInterface
{
    public function charge(int $amount, string $token): void;
}
