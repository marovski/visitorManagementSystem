 @extends('main')

    @section('title', '| Drop Check-out')

    @section('assets')
    <link rel='stylesheet' href='/css/parsley.css' />
    @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Drop Check-out</div>
                <div class="panel-body">
                  {!! Form::model($drop, array('method'=>'put','class'=>'form-horizontal', 'role'=> 'form', 'route' => array('drops.updateCheckOut', $drop->idDrop))) !!}
                    
                        <div class="form-group{{ $errors->has('dropperCompany') ? ' has-error' : '' }}">
                            <label for="dropperCompany" class="col-md-4 control-label">Company Name:</label>
                            <div class="col-md-6">
                            <input id="dropperCompany" type="text" class="form-control" name="dropperCompany" disabled="true" readonly="" value="{{ $drop->dropperCompanyName}}">

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
                                <input id="dropperName" type="text" class="form-control" name="dropperName" disabled="true" readonly="" value="{{ $drop->dropperName }}">

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
                                <input id="ReceiverName" type="text" class="form-control" name="ReceiverName" disabled="true" readonly="" value="{{ $drop->dropReceiver }}" required autofocus>

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

                                <label class="radio-inline"><input type="radio" name="dropSize" disabled="true"  checked="checked" value="">
                                @if ($drop->dropSize=="L")
                                Large 
                                @elseif($drop->dropSize=="M")
                                Medium
                                @elseif($drop->dropSize=="S") 
                                Small
                                @endif
                                </label>

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


                                <select class="form-control" name="dropImportance" disabled="true">    
                                @if ($drop->dropImportance==3)
                                  <option value="">High</option>
                                  @elseif ($drop->dropImportance==2)
                                  <option value="">Medium</option>
                                  @else
                                  <option value="">Small</option>
                                  @endif

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
                                <textarea rows="4" cols="" class="form-control" disabled="true" name="dropDescription" readonly="">{{ $drop->dropDescr }}</textarea>                               

                                @if ($errors->has('dropDescription'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dropDescription') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                                                        
                            <div class="form-group">
                        <div class="col-md-6 col-md-offset-4" >
                            <button type="submit" class="btn btn-basic btn-sm btn-block">
                                Check-out
                            </button>
                            <a href="{{ route('drops.index') }}" class="btn btn-default btn-sm btn-block">Cancel</a>
                        </div>
                    </div>
                     {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<@endsection>