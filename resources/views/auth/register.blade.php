@extends('main')

@section('title', '| Register')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Create your organization account</b></div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('org_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Organization Name</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="org_name"
                                    value="{{ old('org_name') }}" placeholder="Acme Corporation" required autofocus>
                                @if ($errors->has('org_name'))
                                    <span class="help-block"><strong>{{ $errors->first('org_name') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Your Name / Username</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="username"
                                    value="{{ old('username') }}" placeholder="John Smith" required>
                                @if ($errors->has('username'))
                                    <span class="help-block"><strong>{{ $errors->first('username') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Work Email</label>
                            <div class="col-md-7">
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" placeholder="you@company.com" required>
                                @if ($errors->has('email'))
                                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-7">
                                <input type="password" class="form-control" name="password"
                                    placeholder="Min. 8 characters" required>
                                @if ($errors->has('password'))
                                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-7">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="Repeat password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-4">
                                <p class="text-muted small">
                                    By registering you agree to our Terms of Service. Your 14-day free trial starts immediately — no credit card required.
                                </p>
                                <button type="submit" class="btn btn-primary btn-block">
                                    <span class="glyphicon glyphicon-ok"></span> Create Account &amp; Start Free Trial
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-4">
                                <span class="text-muted">Already have an account?</span>
                                <a href="{{ route('login') }}">Login</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
