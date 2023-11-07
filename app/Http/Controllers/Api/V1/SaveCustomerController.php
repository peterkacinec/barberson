<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\V1\CustomerResource;
use App\Services\SaveCustomerService;
use Illuminate\Http\JsonResponse;

class SaveCustomerController extends Controller
{
    public function __construct(private SaveCustomerService $saveCustomerService)
    {
    }

    public function __invoke(StoreCustomerRequest $request): JsonResponse
    {
        $this->saveCustomerService->__invoke($request->validated());

        return new JsonResponse(true, 200);
//        return new CustomerResource();
    }
}
