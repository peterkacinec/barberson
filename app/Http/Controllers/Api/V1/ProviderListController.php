<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\ProviderFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProviderListCollection;
use App\Models\Provider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProviderListController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $filter = new ProviderFilter();
        $queryItems = $filter->transform($request);

        if ($queryItems === []) {
            $resource = new ProviderListCollection(Provider::with('company')->get());
        } else {
            $providers = Provider::with('company')->where($queryItems)->paginate();
            $resource = new ProviderListCollection($providers->appends($request->query()));
        }

        return $this->openApiValidator->validateResponse($request, $resource->response());
    }
}
