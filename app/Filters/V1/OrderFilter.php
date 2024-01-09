<?php

declare(strict_types=1);

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class OrderFilter extends ApiFilter
{
    protected array $allowedParams = [
        'name' => ['eq'],
        'customerId' => ['eq'],
        'providerId' => ['eq'],
        'date' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'totalPrice' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'status' => ['eq', 'ne'],
        'paymentType' => ['eq'],
        'location' => ['eq'],
    ];

    protected array $columnMap = [
        'totalPrice' => 'price',
        'paymentType' => 'payment_type',
        'location' => 'customer_address',
        'providerId' => 'provider_id',
        'customerId' => 'customer_id',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ];
}
