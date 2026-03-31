@extends('main')
@section('title', '| Admin Panel')

@section('content')
<div class="container">
    <h2><span class="glyphicon glyphicon-cog"></span> Admin Panel — {{ $org->name }}</h2>
    <hr>

    {{-- Subscription status banner --}}
    @if($org->isOnTrial())
        <div class="alert alert-info">
            <strong>Free Trial:</strong> {{ $org->trialDaysRemaining() }} day(s) remaining.
            <a href="{{ route('billing.show') }}" class="btn btn-xs btn-primary">Activate Subscription</a>
        </div>
    @elseif($org->isSubscriptionPastDue())
        <div class="alert alert-danger">
            <strong>Payment Past Due!</strong> Please update your billing information.
            <a href="{{ route('billing.show') }}" class="btn btn-xs btn-danger">Update Billing</a>
        </div>
    @endif

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default text-center">
                <div class="panel-body">
                    <h1>{{ $stats['users'] }}</h1>
                    <p>Users <small class="text-muted">/ {{ $plan->max_users == 0 ? '∞' : $plan->max_users }} max</small></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default text-center">
                <div class="panel-body">
                    <h1>{{ $stats['visitors'] }}</h1>
                    <p>Total Visitors</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default text-center">
                <div class="panel-body">
                    <h1>{{ $stats['meetings'] }}</h1>
                    <p>Total Meetings</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-primary text-center">
                <div class="panel-body">
                    <h3>{{ $plan->name }}</h3>
                    <p>Current Plan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin.users') }}" class="btn btn-default btn-block btn-lg">
                <span class="glyphicon glyphicon-user"></span> Manage Users
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.settings') }}" class="btn btn-default btn-block btn-lg">
                <span class="glyphicon glyphicon-wrench"></span> Organization Settings
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('billing.show') }}" class="btn btn-default btn-block btn-lg">
                <span class="glyphicon glyphicon-credit-card"></span> Billing &amp; Plans
            </a>
        </div>
    </div>
</div>
@endsection
