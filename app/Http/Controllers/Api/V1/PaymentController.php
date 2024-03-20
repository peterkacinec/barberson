<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Common\Application\PaymentGatewayInterface;
use App\Http\Requests\PaymentRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PaymentController extends Controller
{
    public function __construct(private PaymentGatewayInterface $paymentService)
    {
    }

    public function createPaymentIntent(PaymentRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $amount = $request->input('amount');
            $currency = $request->input('currency');
            $description = $request->input('description');
            $customerEmail = $request->input('customer_email');

            $paymentIntent = $this->paymentService->createPaymentIntent($amount, $currency, $description, $customerEmail);

            return response()->json(['client_secret' => $paymentIntent['clientSecret']]);
        } catch (Exception $exception) {
            dd($exception);
            throw new Exception(['error' => $exception->getMessage()]);
        }
    }
}
