<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ServiceCollection;
use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceListController extends Controller
{
    public function __invoke(): JsonResource
    {
        return new ServiceCollection(Service::all());
    }
}
