<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditCustomerProfileRequest;
use App\Models\CustomerUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EditCustomerProfileController extends Controller
{
    public function __invoke(EditCustomerProfileRequest $request): JsonResponse
    {
        $data = $request->validated();

        $customerUser = CustomerUser::find($request->user()->id);

        $customerUser->update($data);

        return new JsonResponse(true, Response::HTTP_OK);
    }
}
