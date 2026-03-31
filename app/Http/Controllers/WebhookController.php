<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Plan;
use App\Models\Subscription;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sig     = $request->header('Stripe-Signature');
        $secret  = config('services.stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sig, $secret);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        } catch (\Exception $e) {
            return response('Webhook error: ' . $e->getMessage(), 400);
        }

        switch ($event->type) {
            case 'invoice.payment_succeeded':
                $this->handlePaymentSucceeded($event->data->object);
                break;

            case 'invoice.payment_failed':
                $this->handlePaymentFailed($event->data->object);
                break;

            case 'customer.subscription.updated':
                $this->handleSubscriptionUpdated($event->data->object);
                break;

            case 'customer.subscription.deleted':
                $this->handleSubscriptionDeleted($event->data->object);
                break;
        }

        return response('OK', 200);
    }

    protected function handlePaymentSucceeded($invoice)
    {
        $org = Organization::where('stripe_customer_id', $invoice->customer)->first();

        if (!$org) {
            return;
        }

        $org->update(['subscription_status' => 'active']);

        // Record invoice in local subscriptions table if not already present
        if ($invoice->subscription) {
            Subscription::firstOrCreate(
                ['stripe_invoice_id' => $invoice->id],
                [
                    'organization_id'        => $org->id,
                    'plan_id'                => $org->plan_id,
                    'stripe_subscription_id' => $invoice->subscription,
                    'stripe_invoice_id'      => $invoice->id,
                    'status'                 => 'paid',
                    'amount'                 => $invoice->amount_paid / 100,
                    'currency'               => $invoice->currency,
                    'billing_cycle'          => $org->billing_cycle,
                    'starts_at'              => date('Y-m-d H:i:s', $invoice->period_start),
                    'ends_at'                => date('Y-m-d H:i:s', $invoice->period_end),
                ]
            );
        }
    }

    protected function handlePaymentFailed($invoice)
    {
        $org = Organization::where('stripe_customer_id', $invoice->customer)->first();

        if ($org) {
            $org->update(['subscription_status' => 'past_due']);
        }
    }

    protected function handleSubscriptionUpdated($subscription)
    {
        $org = Organization::where('stripe_subscription_id', $subscription->id)->first();

        if (!$org) {
            return;
        }

        $update = [
            'subscription_status'  => $subscription->status,
            'current_period_start' => date('Y-m-d H:i:s', $subscription->current_period_start),
            'current_period_end'   => date('Y-m-d H:i:s', $subscription->current_period_end),
        ];

        // Sync plan if it changed in Stripe
        if (!empty($subscription->items->data[0]->price->id)) {
            $stripePrice = $subscription->items->data[0]->price->id;
            $plan = Plan::where('stripe_price_id_monthly', $stripePrice)
                ->orWhere('stripe_price_id_annual', $stripePrice)
                ->first();

            if ($plan) {
                $update['plan_id'] = $plan->id;
            }
        }

        $org->update($update);
    }

    protected function handleSubscriptionDeleted($subscription)
    {
        $org = Organization::where('stripe_subscription_id', $subscription->id)->first();

        if ($org) {
            $org->update(['subscription_status' => 'canceled']);
        }
    }
}
