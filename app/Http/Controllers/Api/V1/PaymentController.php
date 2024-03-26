<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Common\Application\PaymentGatewayInterface;
use App\Http\Requests\PaymentRequest;
use Exception;
use Illuminate\Routing\Controller;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\HttpFoundation\JsonResponse;

class PaymentController extends Controller
{
    public function __construct(private PaymentGatewayInterface $paymentService)
    {
    }

    public function createPaymentIntent(PaymentRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        try {
            $paymentIntent = $this->paymentService->createPaymentIntent($requestData, $request->user()->email);

            return new JsonResponse(['transactionId' => $paymentIntent['id']], 200);
        } catch (ApiErrorException $exception) {
            return new JsonResponse(false, 500);
        } catch (Exception $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], 501);
        }
    }
}
