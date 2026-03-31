<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Services\StripeService;
use Auth;
use Session;

class OnboardingController extends Controller
{
    protected $stripe;

    public function __construct(StripeService $stripe)
    {
        $this->middleware('auth');
        $this->stripe = $stripe;
    }

    public function showPlanSelection()
    {
        $plans = Plan::where('is_active', 1)->get();
        return view('onboarding.plan', compact('plans'));
    }

    public function selectPlan(Request $request)
    {
        $this->validate($request, [
            'plan_id'       => 'required|exists:plans,id',
            'billing_cycle' => 'required|in:monthly,annual',
        ]);

        $org  = Auth::user()->organization;
        $plan = Plan::findOrFail($request->plan_id);

        $org->update([
            'plan_id'       => $plan->id,
            'billing_cycle' => $request->billing_cycle,
        ]);

        // Create Stripe customer record upfront
        if (!$org->stripe_customer_id) {
            try {
                $customerId = $this->stripe->createCustomer($org);
                $org->update(['stripe_customer_id' => $customerId]);
            } catch (\Exception $e) {
                // Non-fatal: customer will be created at subscribe time
            }
        }

        Session::flash('success', 'Plan selected. Now set up your payment method.');
        return redirect()->route('onboarding.billing');
    }

    public function showBillingSetup()
    {
        $org      = Auth::user()->organization;
        $plan     = $org->plan;
        $stripeKey = config('services.stripe.key');
        return view('onboarding.billing', compact('org', 'plan', 'stripeKey'));
    }

    public function processBilling(Request $request)
    {
        $this->validate($request, [
            'payment_method_id' => 'required|string',
        ]);

        $org  = Auth::user()->organization;
        $plan = $org->plan;

        try {
            if (!$org->stripe_customer_id) {
                $customerId = $this->stripe->createCustomer($org);
                $org->update(['stripe_customer_id' => $customerId]);
                $org->refresh();
            }

            $this->stripe->attachPaymentMethod($org, $request->payment_method_id);
            $subscription = $this->stripe->createSubscription($org, $plan, $org->billing_cycle);

            $org->update([
                'stripe_subscription_id' => $subscription->id,
                'subscription_status'    => $subscription->status,
                'current_period_start'   => date('Y-m-d H:i:s', $subscription->current_period_start),
                'current_period_end'     => date('Y-m-d H:i:s', $subscription->current_period_end),
            ]);

            return redirect()->route('onboarding.complete');

        } catch (\Exception $e) {
            Session::flash('danger', 'Billing setup failed: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function complete()
    {
        $org = Auth::user()->organization;
        return view('onboarding.complete', compact('org'));
    }
}
