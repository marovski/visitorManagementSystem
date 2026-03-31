@extends('main')
@section('title', '| Organization Settings')

@section('content')
<div class="container">
    <h2><span class="glyphicon glyphicon-wrench"></span> Organization Settings</h2>
    <a href="{{ route('admin.index') }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-arrow-left"></span> Back to Admin</a>
    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><b>General Settings</b></div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Organization Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $org->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $org->phone) }}">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="address" rows="3">{{ old('address', $org->address) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Account Info</b></div>
                <div class="panel-body">
                    <table class="table table-condensed">
                        <tr><td><strong>Plan</strong></td><td>{{ $org->plan->name }}</td></tr>
                        <tr><td><strong>Status</strong></td><td>
                            <span class="label label-{{ $org->subscription_status === 'active' ? 'success' : ($org->subscription_status === 'trialing' ? 'info' : 'danger') }}">
                                {{ ucfirst($org->subscription_status) }}
                            </span>
                        </td></tr>
                        @if($org->current_period_end)
                        <tr><td><strong>Next billing</strong></td><td>{{ $org->current_period_end->format('M j, Y') }}</td></tr>
                        @endif
                        @if($org->isOnTrial())
                        <tr><td><strong>Trial ends</strong></td><td>{{ $org->trial_ends_at->format('M j, Y') }}</td></tr>
                        @endif
                    </table>
                    <a href="{{ route('billing.show') }}" class="btn btn-default">Manage Billing</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
