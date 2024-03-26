<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\CustomerUser;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class StripeWebhookController extends CashierController
{
    //todo do I need it?
    protected function getUserByStripeId($stripeId)
    {
        return CustomerUser::where('stripe_id', $stripeId)->first();
    }

    /**
     * Handle invoice payment succeeded.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleInvoicePaymentSucceeded($payload)
    {
        // Handle The Event
    }
}
