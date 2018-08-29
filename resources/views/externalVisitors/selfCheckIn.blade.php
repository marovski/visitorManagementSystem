
@extends('main')

@section('title', '| Self Check-in')

@section('assets')
<link rel='stylesheet' href='/css/parsley.css' />
@endsection

@section('content')


<div class="row" ng-app="MyApp">

     <div class="col-md-8 col-md-offset-2">
     <div class="panel panel-default" ng-controller="showInputController">
    <div class="panel-heading"><span class="glyphicon glyphicon-blackboard"></span> Visitor Self Check-In</div>

                                                    <!-- LOADING ICON -->
    		    <!-- show loading icon if the loading variable is set to true -->
   			<div ng-show="loading == false"  ><p class="text-center" ><span class="loader"></span></p></div>
            <div class="panel-body"  ng-show="loading == true" > 
            <form  class="form-horizontal" method="post" action="{{ route('visitors.selfSign') }}">
            	 {{ csrf_field() }}
            	  <div class="form-group{{ $errors->has('visitorName') ? ' has-error' : '' }}">
                            <label for="visitorName" class="col-md-4 control-label"> Name:</label>

                            <div class="col-md-6">
                    <input id="visitorName" type="text" class="form-control" name="visitorName" value=""  autofocus   >

                                @if ($errors->has('visitorName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorName') }}</strong>
                                    </span>
                                @endif
                            </div>

                            </div>
                              <div class="form-group{{ $errors->has('visitorCompany') ? ' has-error' : '' }}">
                            <label for="visitorCompany" class="col-md-4 control-label"> Company:</label>

                            <div class="col-md-6">
                    <input id="visitorCompany" type="text" class="form-control" name="visitorCompany" value=""  autofocus    
                              >

                                @if ($errors->has('visitorCompany'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorCompany') }}</strong>
                                    </span>
                                @endif
                            </div>

                            </div>
                                <div class="form-group{{ $errors->has('visitorEmail') ? ' has-error' : '' }}">
                            <label for="visitorEmail" class="col-md-4 control-label"> Email:</label>

                            <div class="col-md-6">
                    <input id="visitorEmail" type="text" class="form-control" name="visitorEmail" value=""  autofocus    
                              >

                                @if ($errors->has('visitorEmail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorEmail') }}</strong>
                                    </span>
                                @endif
                            </div>

                            </div>
       <div class="form-group{{ $errors->has('QrCOde') ? ' has-error' : '' }}">
                            <label for="QrCOde" class="col-md-4 control-label"> QrCOde:</label>

                            <div class="col-md-6">
                <input id="input" type="file" onclick="apaga_campo()">
<a href="#" onclick="ler('webcam')">Webcam</a>

                                @if ($errors->has('QrCOde'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('QrCOde') }}</strong>
                                    </span>
                                @endif
                            </div>

                            </div>


                               <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-basic btn-sm btn-block">
                                    Sign In and Print
                                </button>
                              
                                  <a href="/" class="btn btn-default btn-sm btn-block">Cancel</a>  
                            </div>
                        </div>

            </form>



            </div>
            </div>
            </div>
            </div>
            @endsection


