
  @extends('main')

  @section('title', '| Edit Visitor')

  @section('assets')
  <link rel='stylesheet' href='/css/parsley.css' />
  @endsection

  @section('content')
  
      <div class="row" ng-app="MyApp" ng-controller="showInputController" >

         

      <div class="panel-heading"><span class="glyphicon glyphicon-blackboard"></span> Edit External Visitor</div>

 

    {!! Form::model($externalVisitor, array('method'=>'put','class'=>'form-horizontal', 'role'=> 'form', 'route' => array('visitors.update', $externalVisitor->idVisitor))) !!}
             {{ csrf_field() }}
   
  <div class="col-md-8">
                        

                     

                        

           <div class="form-group{{ $errors->has('visitorName') ? ' has-error' : '' }}">
                            <label for="visitorName" class="col-md-4 control-label"> Name:</label>

                            <div class="col-md-6">
                                <input id="visitorName" ng-cut="$event.preventDefault()" ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()" type="text" disabled="" class="form-control" name="visitorName" value="{{ $externalVisitor->visitorName }}"  >

                                @if ($errors->has('visitorName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorName') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                        </div>
                         <div class="form-group{{ $errors->has('visitorIDType') ? ' has-error' : '' }}">
                            <label for="visitorIDType" class="col-md-4 control-label">Identification Type:</label>

                            <div class="col-md-6"  name="visitorIDType">
                                <select class="form-control">
                                  <option value="1" selected>Passport</option>
                                    <option value="2">Citizen Card</option>
                                    <option value="3" >Driver License</option>
                                 
                                </select>

                               

                                @if ($errors->has('visitorIDType'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorIDType') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('visitorIDnumber') ? ' has-error' : '' }}">
                            <label for="visitorIDnumber" class="col-md-4 control-label">Identification Card Number:</label>

                            <div class="col-md-6">
                                <input id="visitorIDnumber" type="text" ng-cut="$event.preventDefault()" ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()" class="form-control" name="visitorIDnumber" value="{{ $externalVisitor->visitorCitizenCard}}"   ></input>

                                @if ($errors->has('visitorIDnumber'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorIDnumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                              
                        <div class="form-group{{ $errors->has('visitorNPhone') ? ' has-error' : '' }}">
                            <label for="visitorNPhone" class="col-md-4 control-label">Phone Number:</label>

                            <div class="col-md-6">
                            
                                <input id="visitorNPhone" type="text" ng-cut="$event.preventDefault()" ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()" class="form-control" name="visitorNPhone" value="{{$externalVisitor->visitorNPhone  }}"  >

                                @if ($errors->has('visitorNPhone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorNPhone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('visitorEmail') ? ' has-error' : '' }}">
                            <label for="visitorEmail" class="col-md-4 control-label">Email:</label>

                            <div class="col-md-6">
                               <input type="email" class="form-control" id="visitorEmail" name="visitorEmail" value="{{ $externalVisitor->visitorEmail }}" ng-cut="$event.preventDefault()" disabled ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()"></input>

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
                                <input id="visitorCompanyName" type="text" ng-cut="$event.preventDefault()" ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()" disabled="" class="form-control" name="visitorCompanyName" value="{{ $externalVisitor->visitorCompanyName }}"  >

                                @if ($errors->has('visitorCompanyName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorCompanyName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('wifiAccess') ? ' has-error' : '' }}">
                            <label for="wifiAccess" class="col-md-4 control-label">WiFi Access:  </label>

                            <div class="col-md-6">
                              @if($externalVisitor->wifiAcess==1)
                               <p > Has Wifi Acess</p>
                                @else
                                <p> No Wifi Acess</p>
                                 @endif

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
                                <textarea id="visitorDeclaredGood" type="text" class="form-control" name="visitorDeclaredGood" value="{{ $externalVisitor->visitorDeclaredGood }}"   ></textarea> 

                                @if ($errors->has('visitorDeclaredGood'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('visitorDeclaredGood') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('visitorDangerousGood') ? ' has-error' : '' }}">
                            <label for="visitorDangerousGood" class="col-md-4 control-label">Dangerous Goods: @if($externalVisitor->visitorDangerousGood==1)
                              Has Dangerous Goods!
                                @else
                                  No Dangerous Goods
                                   @endif</label>

                            <div class="col-md-6">
                            @if($externalVisitor->visitorDangerousGood==1)
                                            <input id="visitorDangerousGood" type="checkbox" name="visitorDangerousGood" value="1"  checked="">
                                @else
                                               <input id="visitorDangerousGood" type="checkbox" name="visitorDangerousGood" value="1"  >
                                   @endif
                     
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
                            @if($externalVisitor->escorted==1)
                                 <p>Escorted</p>
                                @else
                              <p> Not Escorted</p>
                                @endif

                                @if ($errors->has('escorted')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('escorted') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

           
          </div>


  <div class="col-md-4" > 
    <div class="well">
      <dl class="dl-horizontal">
        <dt>Created At:</dt>
        <dd>{{ date('M j, Y h:ia', strtotime($externalVisitor->created_at)) }}</dd>
      </dl>

      <dl class="dl-horizontal">
        <dt>Last Updated:</dt>
        <dd>{{ date('M j, Y h:ia', strtotime($externalVisitor->updated_at)) }}</dd>
      </dl>
      <hr>
      <div class="row">
        <div class="col-sm-6">
              <button type="submit" class="btn btn-primary btn-block" onclick="return ConfirmExternVisitor()"><span class="glyphicon glyphicon-floppy-save"></span> Save Changes</button>
           
        </div>
        <div class="col-sm-6">
       
         
        <a class="btn btn-danger btn-block"  href="{{ route('meetings.show', $externalVisitor->meeting->first()->idMeeting) }}">Cancel</a>
        </div>
      
      </div>

    </div>
    </div>
    
{!! Form::close() !!}

              </div><!-- end of .row (form) -->
     




 


  @endsection
