<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    public function __invoke(Request $request, Customer $customer): JsonResponse
    {
        $resource = new CustomerResource($customer);

        return $this->openApiValidator->validateResponse($request, $resource->response());
    }
}
