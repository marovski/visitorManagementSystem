    @extends('main')

    @section('title', '| Create New Drop')

    @section('assets')
    <link rel='stylesheet' href='/css/parsley.css' />
    @endsection

@section('content')
<div class="container" ng-app="MyApp">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span> <b>Create Drop</b></div>
                <div class="panel-body" ng-controller="showInputController" >

                            
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('drops.store') }}"  >
                        {{ csrf_field() }}
                    
                        <div class="form-group{{ $errors->has('dropperCompany') ? ' has-error' : '' }}">
                            <label for="dropperCompany" class="col-md-4 control-label">Company Name:</label>

                            <div class="col-md-6">
                                <input id="dropperCompany" type="text" class="dropperCompany form-control" data-provide="dropperCompany" name="dropperCompany" value="{{ old('dropperCompany') }}" ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()" autofocus placeholder='Type here the company name'>

                                @if ($errors->has('dropperCompany'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dropperCompany') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dropperName') ? ' has-error' : '' }}">
                            <label for="dropperName" class="col-md-4 control-label">Dropper Name:</label>

                            <div class="col-md-6">
                                <input id="dropperName" type="text" class="dropperName form-control" data-provide="dropperName" name="dropperName" value="{{ old('dropperName') }}" required autofocus placeholder='Type here the dropper name' ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()">

                                @if ($errors->has('dropperName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dropperName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ReceiverName') ? ' has-error' : '' }}">
                            <label for="ReceiverName" class="col-md-4 control-label">Receiver Name:</label>

                            <div class="col-md-6">
                                <input id="ReceiverName" type="text" class="ReceiverName form-control" data-provide="ReceiverName" name="ReceiverName" value="{{ old('ReceiverName') }}" required autofocus placeholder='Type here the receiver name' ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()">

                                @if ($errors->has('ReceiverName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ReceiverName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('dropSize') ? ' has-error' : '' }}">
                            <label for="dropSize" class="col-md-4 control-label">Item:</label>

                            <div class="col-md-6">
                                <label class="radio-inline"><input type="radio" name="dropSize" value="Small" checked>Small Size</label>
                                <label class="radio-inline"><input type="radio" name="dropSize" value="Medium">Medium Size</label>
                                <label class="radio-inline"><input type="radio" name="dropSize" value="Large">Large Size</label>
                                
                                @if ($errors->has('dropSize'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dropSize') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dropImportance') ? ' has-error' : '' }}">
                            <label for="dropImportance" class="col-md-4 control-label">Importance:</label>

                            <div class="col-md-6" >
                            <p>
                                <select class="form-control" name="dropImportance">
                                  <option value="1">Low</option>
                                  <option value="2">Medium</option>
                                  <option value="3">High</option>
                                </select>

                                @if ($errors->has('dropImportance'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dropImportance') }}</strong>
                                    </span>
                                @endif
                            </p>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dropDescription') ? ' has-error' : '' }}">
                            <label for="dropDescription" class="col-md-4 control-label"> Description:</label>

                            <div class="col-md-6">
                                <textarea rows="4" cols="" class="form-control" name="dropDescription" placeholder='Describe the package' ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()"></textarea>                                

                                @if ($errors->has('dropDescription'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dropDescription') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                                                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-basic btn-sm btn-block">
                                    Save Drop
                                </button>
                                <a href="{{ route('drops.index') }}" class="btn btn-default btn-sm btn-block">Cancel</a>
                            </div>
                           
                        </div>               
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection