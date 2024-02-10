<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderListRequest;
use App\Http\Resources\V1\ProviderListCollection;
use App\Models\Provider;
use Illuminate\Http\JsonResponse;

class ProviderListController extends Controller
{
    public function __invoke(ProviderListRequest $request): JsonResponse
    {
        $requestParams = $request->validated();

        $providers = Provider::with(['company', 'cheapestService'])
            ->withAggregate('comments', 'rating')
            ->where('category_id', '=', $requestParams['categoryId'])
            ->paginate()
        ;

        $resource = new ProviderListCollection($providers->appends($requestParams));

//        $filter = new ProviderFilter();
//        $queryItems = $filter->transform($request);
//
//        if ($queryItems === []) {
//            $resource = new ProviderListCollection(Provider::with('company')->get());
//        } else {
//            $providers = Provider::with('company')->where($queryItems)->paginate();
//            $resource = new ProviderListCollection($providers->appends($request->query()));
//        }

        return $this->openApiValidator->validateResponse($request, $resource->response());
    }
}
