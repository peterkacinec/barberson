<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerSaveController extends Controller
{
    public function __invoke(Customer $customer): JsonResource
    {
        return new CustomerResource($customer);
    }
}
