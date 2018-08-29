 @extends('main')

    @section('title', '| Lost Item Check-out')

    @section('assets')
    <link rel='stylesheet' href='/css/parsley.css' />
    @endsection

@section('content')
<div class="container" ng-app="MyApp">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" ng-controller="showInputController">
                <div class="panel-heading">Item Check-Out</div>
                                            <!-- LOADING ICON -->
            <!-- show loading icon if the loading variable is set to true -->
        <div ng-show="loading == false"  ><p class="text-center" ><span class="loader"></span></p></div>
                       <div class="panel-body" ng-show="loading == true">
    
                  {!! Form::model($lost, array('method'=>'post','class'=>'form-horizontal', 'role'=> 'form', 'route' => array('losts.updateCheckOut', $lost->idLostFound))) !!}

                      <div class="form-group{{ $errors->has('finderName') ? ' has-error' : '' }}" ng-show="loading == true">
                            <label for="finderName" class="col-md-4 control-label">Finder Name:</label>

                            <div class="col-md-6">
                                <input id="finderName" type="text" class="form-control" name="finderName" readonly="" value="{{ $lost->finderName }}" required autofocus>

                                @if ($errors->has('finderName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('finderName') }}</strong>
                                    </span>
                                @endif
                            </div>
                       </div>

                       <div class="form-group{{ $errors->has('finderPhone') ? ' has-error' : '' }}">
                            <label for="finderPhone" class="col-md-4 control-label">Finder Phone:</label>

                            <div class="col-md-6">
                                <input id="finderPhone" type="text" class="form-control" name="finderPhone" readonly="" value="{{ $lost->finderPhone }}" required autofocus>

                                @if ($errors->has('finderPhone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('finderPhone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group{{ $errors->has('receiverName') ? ' has-error' : '' }}">
                            <label for="ReceiverName" class="col-md-4 control-label">Receiver Name:</label>

                            <div class="col-md-6">
                                <input id="ReceiverName" type="text" class="form-control" name="receiverName" value="{{ $lost->receiverName }}" required autofocus ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()">

                                @if ($errors->has('ReceiverName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ReceiverName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('receiverPhone') ? ' has-error' : '' }}">
                            <label for="receiverPhone" class="col-md-4 control-label">Receiver Phone:</label>

                            <div class="col-md-6">
                                <input id="receiverPhone"  type="tel"  class="form-control" name="receiverPhone" value="{{ $lost->receiverPhone  }}"  autofocus>

                                @if ($errors->has('receiverPhone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('receiverPhone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lostFoundDescription') ? ' has-error' : '' }}">
                            <label for="lostFoundDescription" class="col-md-4 control-label"> Description:</label>

                            <div class="col-md-6">
                                <textarea rows="4" cols="" class="form-control" disabled="true" readonly="" name="lostFoundDescription">{{ $lost->itemDescription }}</textarea>                               

                                @if ($errors->has('lostFoundDescription'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lostFoundDescription') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lostFoundItemSize') ? ' has-error' : '' }}">
                            <label for="lostFoundItemSize" class="col-md-4 control-label">Item:</label>
                             <div class="col-md-6">
                                <label class="radio-inline"><input type="radio" name="lostFoundItemSize" readonly=""  disabled="true"  checked="checked" value="">{{ $lost->itemSize}}</label>
                                

                                @if ($errors->has('lostFoundItemSize'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lostFoundItemSize') }}</strong>
                                    </span>
                                @endif
                             </div>
                        </div>

                        <div class="form-group{{ $errors->has('lostFoundImportance') ? ' has-error' : '' }}">
                            <label for="lostFoundImportance" class="col-md-4 control-label">Importance:</label>

                            <div class="col-md-6" >
                            <p>
                                <select class="form-control" name="lostFoundImportance" readonly=""  disabled="true" >

                                @if ($lost->itemImportance==3)
                                  <option value="">High</option>
                                  @elseif ($lost->itemImportance==2)
                                  <option value="">Medium</option>
                                  @else
                                  <option value="">Small</option>
                                  @endif
                                </select>

                                @if ($errors->has('lostFoundImportance'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lostFoundImportance') }}</strong>
                                    </span>
                                @endif
                            </p>
                            </div>
                        </div>

                                                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-basic btn-sm btn-block">
                                    Check-out
                                </button>
                                <a href="{{ route('losts.index') }}" class="btn btn-default btn-sm btn-block">Cancel</a>
                            </div>
                        </div>
                     {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection