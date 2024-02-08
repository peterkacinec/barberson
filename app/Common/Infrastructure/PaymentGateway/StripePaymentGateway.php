<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\PaymentGateway;

use App\Common\Application\PaymentGatewayInterface;
use Illuminate\Support\Facades\Http;

class StripePaymentGateway implements PaymentGatewayInterface
{
    public function __construct(private string $stripeApiKey)
    {}

    public function charge(int $amount, string $token): void
    {
        Http::post("https://api.stripe.com/v1/checkout/sessions", [
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Your Product Name',
                        ],
                        'unit_amount' => 1000, // Amount in cents
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->stripeApiKey,
            ],
        ]);
    }
}
