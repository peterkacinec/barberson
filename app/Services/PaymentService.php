<?php

declare(strict_types=1);

namespace App\Services;

use App\Common\Application\PaymentGatewayInterface;
use App\Models\CustomerUser;
use Laravel\Cashier\Billable;

class PaymentService implements PaymentGatewayInterface
{
    public function createPaymentIntent(int $amount, string $currency, string $description, string $customerEmail): array
    {
        /** @var Billable $user */
        $user = CustomerUser::where('email', $customerEmail)->first();

        if ($user->hasStripeId()) {
            $user->syncStripeCustomerDetails();
        }

        $paymentIntent = $user->checkoutCharge(
            1000,
            'test-name',
            1,
            [
                'invoice_creation' => [
                    'enabled' => true,
                    'invoice_data' => [
                        'description' => 'Invoice for Product X',
                        'metadata' => ['order' => 'order-xyz'],
//                        'account_tax_ids' => ['DE123456789'],
                        'custom_fields' => [
                            [
                                'name' => 'Purchase Order',
                                'value' => 'PO-XYZ',
                            ],
                        ],
                        'rendering_options' => ['amount_tax_display' => 'include_inclusive_tax'],
                        'footer' => 'B2B Inc.',
                    ],
                ],
                'success_url' => "/dakujeme-za-objednavku",
                'cancel_url' => "/cancel_url_todo",
            ],
            [
                'email' => $user->email,
                'phone' => $user->phone,
                'name' => $user->surname
            ],
        // customerOptions
//            [
//                [
//                    'price' => 22*100,
//                    'quantity' => 1,
//                ],
//                [
//                    'price' => 'price_1HKiSf2eZvKYlo2CxjF9qwbr',
//                    'quantity' => 1,
//                ]
//            ],
        );

        return [
            'clientSecret' => $paymentIntent,
        ];
    }
}
