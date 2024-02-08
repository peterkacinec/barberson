<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Services\PaymentService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $paymentService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $amount = $request->input('amount');
        $token = $request->input('token');

        try {
            $this->paymentService->__invoke($amount, $token);
        } catch(Exception) {
            return new JsonResponse(false, 404);
        }

        return new JsonResponse(true);
    }
}
