<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerCollection;
use App\Models\Customer;
use App\Filters\V1\CustomerFilter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerListController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $filter = new CustomerFilter();
        $queryItems = $filter->transform($request);

        if ($queryItems === []) {
            $resource = new CustomerCollection(Customer::with('user')->get());
        } else {
            $customers = Customer::where($queryItems)->paginate();

            $resource = new CustomerCollection($customers->appends($request->query()));
        }

        return $this->openApiValidator->validateResponse($request, $resource->response());
    }
}
