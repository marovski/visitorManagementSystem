

    @extends('main')

    @section('title', '| Create New External Visitor')

    @section('assets')
    <link rel='stylesheet' href='/css/parsley.css' />

    @endsection

    @section('content')
<div class="container" ng-app="MyApp">
        <div class="row" >

                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading"><span class="glyphicon glyphicon-blackboard"></span>  Create New External Visitor for Meeting: <b>{{$meeting->meetingName}}</b></div>
                <div class="panel-body"  ng-controller="showInputController"> 
                           
  <form  class="form-horizontal" role="form" method="POST" action="{{ route('visitors.store') }}" data-parsley-validate="" onsubmit="return ConfirmExternVisitor()"  name="newvisitor">
                        {{ csrf_field() }}
                           <input id="idMeeting" name="idMeeting" class="ng-hide" type="number"  value="{{$meeting->idMeeting}}"/>
              
                        <div class="form-group{{ $errors->has('visitorName') ? ' has-error' : '' }}">
                            <label for="visitorName" class="col-md-4 control-label" ><span class="after">*</span> Name:</label>

                            <div class="col-md-6">
                                <input id="visitorName" type="text" class="visitorName form-control" data-provide="visitorName" name="visitorName" value="{{ old('visitorName') }}"  autofocus  required="" ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()" placeholder="Type here the name">

                                @if ($errors->has('visitorName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorName') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                        </div>
                         <div class="form-group{{ $errors->has('visitorCitizenCardType') ? ' has-error' : '' }}">
                            <label for="visitorCitizenCardType" class="col-md-4 control-label">Identification Type:</label>

                            <div class="col-md-6"  name="visitorCitizenCardType">
                                <select class="form-control" name="visitorCitizenCardType"  ng-model="visitorCitizenCardType">
                                 <option value="1" selected>Passport</option>
                                    <option value="2">Citizen Card</option>
                                    <option value="3" >Driver License</option>
                                 
                                </select>

                               

                                @if ($errors->has('visitorCitizenCardType'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorCitizenCardType') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                      <div class="form-group{{ $errors->has('visitorCitizenCard') ? ' has-error' : '' }}"   >
                            <label for="visitorCitizenCard" class="col-md-4 control-label">Identification Card Number:</label>

                            <div class="col-md-6">
                                <input id="visitorCitizenCard" type="text" ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()"  name="visitorCitizenCard" value="{{ old('visitorCitizenCard') }}" autofocus placeholder="Type here the ID number" >

                                @if ($errors->has('visitorCitizenCard'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('visitorCitizenCard') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
          
                         

                               
                        <div class="form-group{{ $errors->has('visitorNPhone') ? ' has-error' : '' }}">
                            <label for="visitorNPhone" class="col-md-4 control-label">Phone Number:</label>

                            <div class="col-md-6">
                            
                                <input placeholder="Type here the phone number" id="visitorNPhone" type="text" min="17"  class="visitorNPhone form-control" name="visitorNPhone" value="{{ old('visitorNPhone') }}"  autofocus ng-model="visitorNPhone" ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()" data-provide="visitorNPhone">

                                @if ($errors->has('visitorNPhone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorNPhone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('visitorEmail') ? ' has-error' : '' }}">
                            <label for="visitorEmail" class="col-md-4 control-label"><span class="after">*</span> Email:</label>

                            <div class="col-md-6">
                               <input placeholder="Type here the email" type="email" class="visitorEmail form-control" name="visitorEmail" required="" ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()" data-provide="visitorEmail"></input>

                                @if ($errors->has('visitorEmail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorEmail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('visitorEmail') ? ' has-error' : '' }}">
                            <label for="visitorEmail" class="col-md-4 control-label"><span class="after">*</span> Confirm Email:</label>

                            <div class="col-md-6">
                               <input placeholder="Confirm the email" type="email" class="form-control" name="visitorEmail" required="" ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()"></input>

                                @if ($errors->has('visitorEmail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorEmail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('visitorCompanyName') ? ' has-error' : '' }}">
                            <label for="visitorCompanyName" class="col-md-4 control-label">Company:</label>

                            <div class="col-md-6">
                                <input placeholder="Type here the company name" id="visitorCompanyName" type="text" class="visitorCompanyName form-control" name="visitorCompanyName" data-provide="visitorCompanyName" value="{{ old('visitorCompanyName') }}"  autofocus ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()" >

                                @if ($errors->has('visitorCompanyName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorCompanyName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('wifiAccess') ? ' has-error' : '' }}">
                            <label for="wifiAccess" class="col-md-4 control-label">WiFi Access:</label>

                            <div class="col-md-6">
                                <input id="wifiAccess" type="checkbox" name="wifiAccess" value="1" checked >

                                @if ($errors->has('wifiAccess')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('wifiAccess') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('visitorDeclaredGood') ? ' has-error' : '' }}">
                            <label for="visitorDeclaredGood" class="col-md-4 control-label">Declared Goods:</label>

                            <div class="col-md-6">
                                <textarea placeholder="Type here the goods" id="visitorDeclaredGood" type="text" class="form-control" name="visitorDeclaredGood"   autofocus  ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()">
                                </textarea> 
                                @if ($errors->has('visitorDeclaredGood'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorDeclaredGood') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('visitorDangerousGood') ? ' has-error' : '' }}">
                            <label for="visitorDangerousGood" class="col-md-4 control-label">Dangerous Goods:</label>

                            <div class="col-md-6">
                                <input id="visitorDangerousGood" type="checkbox" name="visitorDangerousGood" value="1"   >

                                @if ($errors->has('visitorDangerousGood')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorDangerousGood') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('escorted') ? ' has-error' : '' }}">
                            <label for="escorted" class="col-md-4 control-label">Escorted:</label>

                            <div class="col-md-6">
                                <input id="escorted" type="checkbox" name="escorted" value="1" checked=""  >

                                @if ($errors->has('escorted')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('escorted') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                                                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-basic btn-sm btn-block">
                                    Save
                                </button>
                              
                                  <a href="{{ route('meetings.show', $meeting->idMeeting) }}" class="btn btn-default btn-sm btn-block">Cancel</a>  
                            </div>
                        </div>
                        
                  </form>
                </div>
                </div>
                </div>
                </div>
                
         </div>
       

        @endsection


