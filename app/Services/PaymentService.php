<?php

declare(strict_types=1);

namespace App\Services;

use App\Common\Application\PaymentGatewayInterface;
use App\Models\CustomerUser;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentService implements PaymentGatewayInterface
{
    public function createPaymentIntent(array $requestData, string $customerEmail): array
    {
        Stripe::setApiKey(config('cashier.secret'));

//        /** @var Billable|CustomerUser $user */
        $customerUser = CustomerUser::where('email', $customerEmail)->first();

        if ($customerUser->hasStripeId()) {
            $customerUser->syncStripeCustomerDetails();
        } else {
            $customerUser->createOrGetStripeCustomer($this->mapUserToStripeUser($customerUser));
        }

        return $this->createCheckoutSession($requestData, $customerUser->stripe_id);
    }

    private function createCheckoutSession(array $requestData, string $customerUserId): array
    {
        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'customer' => $customerUserId,
            'line_items' => $this->buildLineItems($requestData['paymentItems']),
            'mode' => 'payment',
            'success_url' => config('app.frontend_hostname') . '/dakujeme-za-objednavku',
            'cancel_url' => config('app.frontend_hostname') . '/cancel_url_todo',
            'invoice_creation' => [
                'enabled' => true
            ],
        ]);

        return $checkout_session->toArray();
    }

    private function buildLineItems(array $paymentItems): array
    {
        $result = [];

        foreach ($paymentItems as $item) {
            $result[] = [
                'price_data' => [
                    'product_data' => [
                        'name' => $item['name']
                    ],
                    'unit_amount' => $item['price'],
                    'currency' => 'eur'
                ],
                'quantity' => 1
            ];
        }

        return $result;
    }

    private function mapUserToStripeUser(CustomerUser $customerUser): array
    {
        return [
            'name' => $customerUser->fullName,
            'email' => $customerUser->email,
            'phone' => $customerUser->phone,
            'address' => null, //todo
            'preferred_locales' => [$customerUser->language],
            'metadata' => null,
        ];
    }
}
