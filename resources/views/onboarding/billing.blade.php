@extends('main')
@section('title', '| Set Up Billing')

@section('assets')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Set Up Billing</b></div>
                <div class="panel-body">

                    <div class="alert alert-info">
                        <strong>Selected Plan:</strong> {{ $plan->name }} —
                        ${{ number_format($org->billing_cycle === 'annual' ? $plan->price_annual : $plan->price_monthly, 2) }}
                        / {{ $org->billing_cycle }}
                        <br><small>Your 14-day trial starts now. You will not be charged until the trial ends.</small>
                    </div>

                    <form id="payment-form" method="POST" action="{{ url('onboarding/billing') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="payment_method_id" id="payment-method-id">

                        <div class="form-group">
                            <label>Card Information</label>
                            <div id="card-element" style="border: 1px solid #ccc; padding: 10px; border-radius: 4px; background: #fff;">
                                <!-- Stripe card element renders here -->
                            </div>
                            <div id="card-errors" class="text-danger" style="margin-top: 5px;"></div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" id="submit-btn">
                            <span class="glyphicon glyphicon-lock"></span> Save Card &amp; Start Trial
                        </button>
                    </form>

                    <p class="text-muted text-center" style="margin-top: 10px;">
                        <small><span class="glyphicon glyphicon-lock"></span> Secured by Stripe. We never store card details.</small>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
var stripe = Stripe('{{ $stripeKey }}');
var elements = stripe.elements();
var cardElement = elements.create('card');
cardElement.mount('#card-element');

cardElement.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    displayError.textContent = event.error ? event.error.message : '';
});

document.getElementById('payment-form').addEventListener('submit', function(event) {
    event.preventDefault();
    var btn = document.getElementById('submit-btn');
    btn.disabled = true;
    btn.textContent = 'Processing...';

    stripe.createPaymentMethod({
        type: 'card',
        card: cardElement,
    }).then(function(result) {
        if (result.error) {
            document.getElementById('card-errors').textContent = result.error.message;
            btn.disabled = false;
            btn.innerHTML = '<span class="glyphicon glyphicon-lock"></span> Save Card & Start Trial';
        } else {
            document.getElementById('payment-method-id').value = result.paymentMethod.id;
            event.target.submit();
        }
    });
});
</script>
@endsection
