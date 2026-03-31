@extends('main')
@section('title', '| Billing & Plans')

@section('assets')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
<div class="container">
    <h2><span class="glyphicon glyphicon-credit-card"></span> Billing &amp; Plans</h2>
    <a href="{{ route('admin.index') }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-arrow-left"></span> Back to Admin</a>
    <hr>

    <div class="row">
        {{-- Current subscription --}}
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Current Subscription</b></div>
                <div class="panel-body">
                    <table class="table table-condensed">
                        <tr>
                            <td><strong>Plan</strong></td>
                            <td>{{ $plan->name }}
                                <span class="label label-{{ $org->subscription_status === 'active' ? 'success' : ($org->subscription_status === 'trialing' ? 'info' : 'danger') }}">
                                    {{ ucfirst($org->subscription_status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Billing</strong></td>
                            <td>{{ ucfirst($org->billing_cycle) }} — ${{ number_format($org->billing_cycle === 'annual' ? $plan->price_annual : $plan->price_monthly, 2) }}</td>
                        </tr>
                        @if($org->isOnTrial())
                        <tr>
                            <td><strong>Trial Ends</strong></td>
                            <td>{{ $org->trial_ends_at->format('M j, Y') }} ({{ $org->trialDaysRemaining() }} days left)</td>
                        </tr>
                        @endif
                        @if($org->current_period_end)
                        <tr>
                            <td><strong>Next Billing</strong></td>
                            <td>{{ $org->current_period_end->format('M j, Y') }}</td>
                        </tr>
                        @endif
                    </table>

                    {{-- Change plan --}}
                    <button class="btn btn-default" data-toggle="collapse" data-target="#change-plan-section">
                        Change Plan
                    </button>

                    @if($org->stripe_subscription_id)
                    <form method="POST" action="{{ route('billing.cancel') }}" style="display:inline"
                        onsubmit="return confirm('Are you sure you want to cancel? You will keep access until the end of the billing period.')">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">Cancel Subscription</button>
                    </form>
                    @endif
                </div>
            </div>

            {{-- Change plan collapse --}}
            <div id="change-plan-section" class="collapse">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Change Plan</b></div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('billing.update-plan') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Plan</label>
                                <select class="form-control" name="plan_id">
                                    @foreach($plans as $p)
                                    <option value="{{ $p->id }}" {{ $p->id == $plan->id ? 'selected' : '' }}>
                                        {{ $p->name }} — ${{ number_format($p->price_monthly, 2) }}/mo
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Billing Cycle</label>
                                <select class="form-control" name="billing_cycle">
                                    <option value="monthly" {{ $org->billing_cycle === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="annual" {{ $org->billing_cycle === 'annual' ? 'selected' : '' }}>Annual (save ~17%)</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Plan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Payment method --}}
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Payment Method</b></div>
                <div class="panel-body">
                    @if($paymentMethod)
                        <p>
                            <span class="glyphicon glyphicon-credit-card"></span>
                            <strong>{{ strtoupper($paymentMethod->card->brand) }}</strong>
                            ending in {{ $paymentMethod->card->last4 }}
                            — expires {{ $paymentMethod->card->exp_month }}/{{ $paymentMethod->card->exp_year }}
                        </p>
                    @else
                        <p class="text-muted">No payment method on file.</p>
                    @endif

                    @if(!$org->stripe_subscription_id)
                        <p><a href="{{ route('onboarding.billing') }}" class="btn btn-primary">Set Up Billing</a></p>
                    @else
                        <button class="btn btn-default" data-toggle="collapse" data-target="#update-card-section">Update Card</button>

                        <div id="update-card-section" class="collapse" style="margin-top: 15px;">
                            <form id="update-card-form" method="POST" action="{{ route('billing.payment') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="payment_method_id" id="update-pm-id">
                                <div id="update-card-element" style="border: 1px solid #ccc; padding: 10px; border-radius: 4px;"></div>
                                <div id="update-card-errors" class="text-danger" style="margin-top: 5px;"></div>
                                <button type="submit" class="btn btn-primary" style="margin-top: 10px;" id="update-card-btn">Update Card</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Invoice history --}}
            <div class="panel panel-default">
                <div class="panel-heading"><b>Invoice History</b></div>
                <div class="panel-body">
                    @if(count($invoices) > 0)
                        <table class="table table-condensed">
                            <thead><tr><th>Date</th><th>Amount</th><th>Status</th><th></th></tr></thead>
                            <tbody>
                                @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ date('M j, Y', $invoice->created) }}</td>
                                    <td>${{ number_format($invoice->amount_paid / 100, 2) }}</td>
                                    <td>
                                        <span class="label label-{{ $invoice->status === 'paid' ? 'success' : 'danger' }}">
                                            {{ ucfirst($invoice->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($invoice->invoice_pdf)
                                            <a href="{{ $invoice->invoice_pdf }}" target="_blank" class="btn btn-xs btn-default">PDF</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No invoices yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($stripeKey)
<script>
var stripe = Stripe('{{ $stripeKey }}');
var elements = stripe.elements();
var updateCardElement = elements.create('card');
updateCardElement.mount('#update-card-element');

updateCardElement.on('change', function(event) {
    document.getElementById('update-card-errors').textContent = event.error ? event.error.message : '';
});

document.getElementById('update-card-form').addEventListener('submit', function(e) {
    e.preventDefault();
    var btn = document.getElementById('update-card-btn');
    btn.disabled = true;

    stripe.createPaymentMethod({ type: 'card', card: updateCardElement }).then(function(result) {
        if (result.error) {
            document.getElementById('update-card-errors').textContent = result.error.message;
            btn.disabled = false;
        } else {
            document.getElementById('update-pm-id').value = result.paymentMethod.id;
            e.target.submit();
        }
    });
});
</script>
@endif
@endsection
