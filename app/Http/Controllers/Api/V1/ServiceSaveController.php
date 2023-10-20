<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Resources\V1\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceSaveController extends Controller
{
    public function __invoke(StoreServiceRequest $request): JsonResource
    {
        return new ServiceResource(Service::create($request->validated()));
    }
}
