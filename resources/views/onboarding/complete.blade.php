@extends('main')
@section('title', '| Welcome!')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <div class="panel panel-success" style="margin-top: 40px;">
                <div class="panel-body" style="padding: 40px;">
                    <span class="glyphicon glyphicon-ok-circle" style="font-size: 64px; color: #5cb85c;"></span>
                    <h2>You're all set!</h2>
                    <p class="text-muted">Your <strong>{{ $org->name }}</strong> account is ready.</p>

                    @if($org->isOnTrial())
                        <div class="alert alert-info">
                            Your <strong>14-day free trial</strong> ends on
                            <strong>{{ $org->trial_ends_at->format('F j, Y') }}</strong>.
                            No charges until then.
                        </div>
                    @endif

                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-home"></span> Go to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
