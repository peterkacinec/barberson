<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Common\Infrastructure\OpenApi\OpenApiValidator;
use App\Filters\V1\ProviderFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProviderListCollection;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderListController extends Controller
{
    public function __construct(private OpenApiValidator $openApiValidator)
    {
    }

    public function __invoke(Request $request): JsonResource
    {
        $filter = new ProviderFilter();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new ProviderListCollection(Provider::with('company')->get());
        } else {
            $providers = Provider::with('company')->where($queryItems)->paginate();

//            $this->openApiValidator->validateResponse();
            return new ProviderListCollection($providers->appends($request->query()));
        }
    }
}
