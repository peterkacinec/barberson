<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderDetailController extends Controller
{
    public function __invoke(Provider $provider): JsonResource
    {
        return new ProviderResource($provider);
    }
}
