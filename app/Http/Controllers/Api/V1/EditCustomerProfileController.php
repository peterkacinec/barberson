<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditCustomerProfileRequest;
use App\Models\Customer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EditCustomerProfileController extends Controller
{
    public function __invoke(EditCustomerProfileRequest $request, Customer $customer): JsonResponse
    {
        $data = $request->validated();

        if ($request->user()->id !== $customer->user->id) {
            return new JsonResponse(false, Response::HTTP_UNAUTHORIZED);
        }

        $customer->user->update($data);

        return new JsonResponse(true, Response::HTTP_OK);
    }
}
