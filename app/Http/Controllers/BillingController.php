<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StripeService;
use App\Models\Plan;
use App\Models\Subscription;
use Auth;
use Session;

class BillingController extends Controller
{
    protected $stripe;

    public function __construct(StripeService $stripe)
    {
        $this->middleware(['auth', 'org.active', 'org.admin']);
        $this->stripe = $stripe;
    }

    /**
     * Show billing overview: current plan, payment method, invoices.
     */
    public function show()
    {
        $org     = Auth::user()->organization;
        $plan    = $org->plan;
        $plans   = Plan::where('is_active', 1)->get();
        $invoices = $this->stripe->getInvoices($org);
        $paymentMethod = $this->stripe->getDefaultPaymentMethod($org);
        $stripeKey = config('services.stripe.key');

        return view('admin.billing.show', compact('org', 'plan', 'plans', 'invoices', 'paymentMethod', 'stripeKey'));
    }

    /**
     * Initial subscription: attach payment method then create subscription.
     */
    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'payment_method_id' => 'required|string',
        ]);

        $org  = Auth::user()->organization;
        $plan = $org->plan;

        try {
            // Create Stripe customer if not yet created
            if (!$org->stripe_customer_id) {
                $customerId = $this->stripe->createCustomer($org);
                $org->update(['stripe_customer_id' => $customerId]);
            }

            $this->stripe->attachPaymentMethod($org, $request->payment_method_id);
            $subscription = $this->stripe->createSubscription($org, $plan, $org->billing_cycle);

            $org->update([
                'stripe_subscription_id' => $subscription->id,
                'subscription_status'    => $subscription->status,
                'current_period_start'   => date('Y-m-d H:i:s', $subscription->current_period_start),
                'current_period_end'     => date('Y-m-d H:i:s', $subscription->current_period_end),
            ]);

            // Record in local subscriptions table
            Subscription::create([
                'organization_id'        => $org->id,
                'plan_id'                => $plan->id,
                'stripe_subscription_id' => $subscription->id,
                'status'                 => $subscription->status,
                'amount'                 => $plan->price_monthly,
                'currency'               => 'usd',
                'billing_cycle'          => $org->billing_cycle,
                'starts_at'              => date('Y-m-d H:i:s', $subscription->current_period_start),
                'ends_at'                => date('Y-m-d H:i:s', $subscription->current_period_end),
            ]);

            Session::flash('success', 'Subscription activated successfully!');
            return redirect()->route('billing.show');

        } catch (\Exception $e) {
            Session::flash('danger', 'Billing setup failed: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update (upgrade/downgrade) the subscription plan.
     */
    public function updatePlan(Request $request)
    {
        $this->validate($request, [
            'plan_id'       => 'required|exists:plans,id',
            'billing_cycle' => 'required|in:monthly,annual',
        ]);

        $org     = Auth::user()->organization;
        $newPlan = Plan::findOrFail($request->plan_id);

        try {
            $this->stripe->changePlan($org, $newPlan, $request->billing_cycle);

            $org->update([
                'plan_id'       => $newPlan->id,
                'billing_cycle' => $request->billing_cycle,
            ]);

            Session::flash('success', 'Plan updated successfully!');
            return redirect()->route('billing.show');

        } catch (\Exception $e) {
            Session::flash('danger', 'Plan change failed: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Update the default payment method.
     */
    public function updatePaymentMethod(Request $request)
    {
        $this->validate($request, [
            'payment_method_id' => 'required|string',
        ]);

        $org = Auth::user()->organization;

        try {
            $this->stripe->attachPaymentMethod($org, $request->payment_method_id);
            Session::flash('success', 'Payment method updated successfully!');
        } catch (\Exception $e) {
            Session::flash('danger', 'Failed to update payment method: ' . $e->getMessage());
        }

        return redirect()->route('billing.show');
    }

    /**
     * Cancel the subscription at period end.
     */
    public function cancel(Request $request)
    {
        $org = Auth::user()->organization;

        if (!$org->stripe_subscription_id) {
            Session::flash('danger', 'No active subscription to cancel.');
            return redirect()->route('billing.show');
        }

        try {
            $this->stripe->cancelSubscription($org);
            Session::flash('success', 'Your subscription has been cancelled. You will have access until the end of the current billing period.');
        } catch (\Exception $e) {
            Session::flash('danger', 'Cancellation failed: ' . $e->getMessage());
        }

        return redirect()->route('billing.show');
    }
}
