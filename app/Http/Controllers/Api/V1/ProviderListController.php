<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\ProviderFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProviderListCollection;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderListController extends Controller
{
    public function __invoke(Request $request): JsonResource
    {
        $filter = new ProviderFilter();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new ProviderListCollection(Provider::all());
        } else {
            $customers = Provider::where($queryItems)->paginate();

            return new ProviderListCollection($customers->appends($request->query()));
        }
    }
}
