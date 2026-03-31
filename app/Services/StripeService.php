<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\Invoice;
use Stripe\PaymentMethod;
use App\Models\Organization;
use App\Models\Plan;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a Stripe customer for a new organization.
     */
    public function createCustomer(Organization $org)
    {
        $customer = Customer::create([
            'email'    => $org->email,
            'name'     => $org->name,
            'metadata' => ['organization_id' => $org->id],
        ]);

        return $customer->id;
    }

    /**
     * Attach a payment method and set it as the customer's default.
     */
    public function attachPaymentMethod(Organization $org, $paymentMethodId)
    {
        $pm = PaymentMethod::retrieve($paymentMethodId);
        $pm->attach(['customer' => $org->stripe_customer_id]);

        Customer::update($org->stripe_customer_id, [
            'invoice_settings' => ['default_payment_method' => $paymentMethodId],
        ]);
    }

    /**
     * Create a subscription with a 14-day trial.
     */
    public function createSubscription(Organization $org, Plan $plan, $billingCycle = 'monthly')
    {
        $priceId = $plan->getStripePriceId($billingCycle);

        if (!$priceId) {
            throw new \Exception("No Stripe price ID configured for plan '{$plan->name}' ({$billingCycle}).");
        }

        return Subscription::create([
            'customer'           => $org->stripe_customer_id,
            'items'              => [['price' => $priceId]],
            'trial_period_days'  => 14,
            'metadata'           => [
                'organization_id' => $org->id,
                'plan_id'         => $plan->id,
            ],
        ]);
    }

    /**
     * Cancel a subscription at period end (graceful cancellation).
     */
    public function cancelSubscription(Organization $org)
    {
        return Subscription::update($org->stripe_subscription_id, [
            'cancel_at_period_end' => true,
        ]);
    }

    /**
     * Upgrade or downgrade to a different plan.
     */
    public function changePlan(Organization $org, Plan $newPlan, $billingCycle = 'monthly')
    {
        $priceId = $newPlan->getStripePriceId($billingCycle);

        if (!$priceId) {
            throw new \Exception("No Stripe price ID configured for plan '{$newPlan->name}' ({$billingCycle}).");
        }

        $sub = Subscription::retrieve($org->stripe_subscription_id);

        return Subscription::update($org->stripe_subscription_id, [
            'items' => [[
                'id'    => $sub->items->data[0]->id,
                'price' => $priceId,
            ]],
            'proration_behavior' => 'always_invoice',
        ]);
    }

    /**
     * Retrieve recent invoices for a customer.
     */
    public function getInvoices(Organization $org, $limit = 10)
    {
        if (!$org->stripe_customer_id) {
            return [];
        }

        $response = Invoice::all([
            'customer' => $org->stripe_customer_id,
            'limit'    => $limit,
        ]);

        return $response->data;
    }

    /**
     * Retrieve the default payment method details.
     */
    public function getDefaultPaymentMethod(Organization $org)
    {
        if (!$org->stripe_customer_id) {
            return null;
        }

        $customer = Customer::retrieve([
            'id'     => $org->stripe_customer_id,
            'expand' => ['invoice_settings.default_payment_method'],
        ]);

        return $customer->invoice_settings->default_payment_method ?? null;
    }
}
