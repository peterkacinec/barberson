<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerCollection;
use App\Models\Customer;
use App\Filters\V1\CustomerFilter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerListController extends Controller
{
    public function __invoke(Request $request): JsonResource
    {
        $filter = new CustomerFilter();
        $queryItems = $filter->transform($request);

        if ($queryItems === []) {
            return new CustomerCollection(Customer::with('user')->get());
        } else {
            $customers = Customer::where($queryItems)->paginate();

            return new CustomerCollection($customers->appends($request->query()));
        }
    }
}
