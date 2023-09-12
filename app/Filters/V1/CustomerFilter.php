<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class CustomerFilter extends ApiFilter
{
    protected $allowedParams = [
        'name' => ['eq'],
        'surname' => ['eq'],
        'birthday' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'email' => ['eq'],
        'phone' => ['eq'],
        'gender' => ['eq'],
    ];

    protected $columnMap = [
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ];
}
