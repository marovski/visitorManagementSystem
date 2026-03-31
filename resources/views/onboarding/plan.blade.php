@extends('main')
@section('title', '| Choose Your Plan')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Choose Your Plan</h2>
            <p class="text-muted">You're on a 14-day free trial. Select a plan to continue after the trial.</p>

            <div class="btn-group" role="group" style="margin-bottom: 20px;">
                <button type="button" class="btn btn-default active" id="btn-monthly" onclick="toggleBilling('monthly')">Monthly</button>
                <button type="button" class="btn btn-default" id="btn-annual" onclick="toggleBilling('annual')">Annual <span class="label label-success">Save 17%</span></button>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($plans as $plan)
        <div class="col-md-4">
            <div class="panel panel-{{ $loop->iteration == 2 ? 'primary' : 'default' }}">
                @if($loop->iteration == 2)
                    <div class="panel-heading text-center"><b>Most Popular</b></div>
                @endif
                <div class="panel-body text-center">
                    <h3>{{ $plan->name }}</h3>
                    <div class="price-monthly">
                        <h1><strong>${{ number_format($plan->price_monthly, 0) }}</strong><small>/mo</small></h1>
                    </div>
                    <div class="price-annual" style="display:none;">
                        <h1><strong>${{ number_format($plan->price_annual, 0) }}</strong><small>/yr</small></h1>
                        <small class="text-success">Save ${{ number_format(($plan->price_monthly * 12) - $plan->price_annual, 0) }}/year</small>
                    </div>
                    <hr>
                    <ul class="list-unstyled">
                        <li><span class="glyphicon glyphicon-user"></span> {{ $plan->max_users == 0 ? 'Unlimited' : $plan->max_users }} Users</li>
                        <li><span class="glyphicon glyphicon-eye-open"></span> {{ $plan->max_visitors_per_month == 0 ? 'Unlimited' : number_format($plan->max_visitors_per_month) }} Visitors/mo</li>
                        @foreach($plan->features_array as $feature)
                            <li><span class="glyphicon glyphicon-ok text-success"></span> {{ ucwords(str_replace('_', ' ', $feature)) }}</li>
                        @endforeach
                    </ul>
                    <hr>
                    <form method="POST" action="{{ url('onboarding/plan') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                        <input type="hidden" name="billing_cycle" class="billing-cycle-input" value="monthly">
                        <button type="submit" class="btn btn-{{ $loop->iteration == 2 ? 'primary' : 'default' }} btn-block">
                            Select {{ $plan->name }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
function toggleBilling(cycle) {
    if (cycle === 'monthly') {
        document.querySelectorAll('.price-monthly').forEach(function(el) { el.style.display = 'block'; });
        document.querySelectorAll('.price-annual').forEach(function(el) { el.style.display = 'none'; });
        document.getElementById('btn-monthly').classList.add('active');
        document.getElementById('btn-annual').classList.remove('active');
    } else {
        document.querySelectorAll('.price-monthly').forEach(function(el) { el.style.display = 'none'; });
        document.querySelectorAll('.price-annual').forEach(function(el) { el.style.display = 'block'; });
        document.getElementById('btn-annual').classList.add('active');
        document.getElementById('btn-monthly').classList.remove('active');
    }
    document.querySelectorAll('.billing-cycle-input').forEach(function(el) { el.value = cycle; });
}
</script>
@endsection
