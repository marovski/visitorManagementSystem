
    @extends('main')

    @section('title', '| Edit Meeting')

    @section('assets')
    <link rel='stylesheet' href='/css/parsley.css' />
    @endsection

    @section('content')
    
        <div class="row">

           
          
                    <div class="panel-heading"><span class="glyphicon glyphicon-blackboard"></span> Edit Meeting <b>{{$meetingData->meetingId}}</b> </div>
                    <div class="col-md-8">

                               {!! Form::model($meetingData, array('method'=>'put','class'=>'form-horizontal', 'role'=> 'form', 'route' => array('meetings.update', $meetingData->idMeeting))) !!}
                       
                            {{ csrf_field() }}

                           <div class="form-group{{ $errors->has('$meetingData->meetingName') ? ' has-error' : '' }}">
                              <label for="meetingName" class="col-md-4 control-label">Meeting Topic:</label>

                              <div class="col-md-6">
                                  <textarea rows="4" cols="" class="form-control" name="meetingTopic" readonly value="{{$meetingData->meetingName}}">{{$meetingData->meetingName}}</textarea>                                

                                  @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                                  @endif
                              </div>
                              </div>

                        <div class="form-group{{ $errors->has('$meetingData->meetStartDate') ? ' has-error' : '' }}">
                              <label for="meetStartDate" class="col-md-4 control-label">Start Date:</label>

                              <div class="col-md-6">
                                  <input id="meetStartDate" type="text" class="form-control" name="meetStartDate" readonly="" value="{{$meetingData->meetStartDate}}"  >

                                  @if ($errors->has('meetStartDate'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('meetStartDate') }}</strong>
                                  </span>
                                  @endif
                              </div>
                              
                          </div>
                          
                          <div class="form-group{{ $errors->has('$meetingData->meetEndDate') ? ' has-error' : '' }}">
                              <label for="meetEndDate" class="col-md-4 control-label">End Date:</label>

                              <div class="col-md-6">
                                  <input id="meetEndDate" type="text" class="form-control" name="meetEndDate" readonly="" value="{{ $meetingData->meetEndDate}}" >

                                  @if ($errors->has('meetEndDate'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('meetEndDate') }}</strong>
                                  </span>
                                  @endif
                              </div>
                              
                          </div>

                          

                          <div class="form-group{{ $errors->has('room') ? ' has-error' : '' }}">
                              <label for="room" class="col-md-4 control-label">Room:</label>

                              <div class="col-md-6">

                                  <p>
                                      <select class="form-control" name="room" value="{{ $meetingData->room }}">
                                        <option value="1">Room 1</option>
                                        <option value="2">Room 2</option>
                                        <option value="3">Room 3</option>
                                        <option value="4">Room 4</option>
                                        <option value="5">Room 5</option>
                                    </select>


                                    @if ($errors->has('room'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('room') }}</strong>
                                  </span>
                                  @endif
                              </p>
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('$meetingData->visitReason') ? ' has-error' : '' }}">
                          <label for="visitReason" class="col-md-4 control-label"> Meeting Purpose:</label>

                          <div class="col-md-6">
                              <textarea rows="4" cols="" class="form-control" name="visitReason" readonly="" value="{{$meetingData->visitReason}}">{{$meetingData->visitReason}}</textarea>                                

                              @if ($errors->has('visitReason'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('visitReason') }}</strong>
                              </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('$meetingData->confidentiality') ? ' has-error' : '' }}">
                          <label for="confidentiality" class="col-md-4 control-label">Confidentiality:</label>

                          <div class="col-md-6">
                              @if ($meetingData->confidentiality==1)
                          <p> Top Secret</p>
                              @else
                         <p>    Unclassified</p>
                              @endif

                              @if ($errors->has('confidentiality'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('confidentiality') }}</strong>
                              </span>
                              @endif
                          </div>
                      </div>


                      <div class="form-group{{ $errors->has('$meetingData->sensibility') ? ' has-error' : '' }}">
                          <label for="sensibility" class="col-md-4 control-label">Sensibility:</label>

                          <div class="col-md-6">
                          @if($meetingData->sensibility==3)
                           <label class="radio-inline"><input type="radio" name="sensibility" value="3" checked="" readonly>High</label>
                           @elseif($meetingData->sensibility==2)
                           <label class="radio-inline"><input type="radio" name="sensibility" value="2" checked readonly>Medium </label>
                           @else
                           <label class="radio-inline"><input type="radio" name="sensibility" value="1" checked readonly="">Small</label>
                           @endif
                           @if ($errors->has('sensibility'))
                           <span class="help-block">
                              <strong>{{ $errors->first('sensibility') }}</strong>
                          </span>
                          @endif
                      </div>
                  </div>

                  <div class="form-group{{ $errors->has('$meetingData->meetStatus') ? ' has-error' : '' }}">
                      <label for="meetStatus" class="col-md-4 control-label">Current Status:@if($meetingData->meetStatus==1)
                                Scheduled
                                @elseif($meetingData->meetStatus==2)
                                Waiting Confirmation
                                @elseif($meetingData->meetStatus==3)
                                Canceled
                                @else
                                Finished
                                @endif</label>

                      <div class="col-md-6" >
                          <p>
                              <select class="form-control" value="scheduled" name="meetStatus"  >
                             
                             <option value="1">Scheduled</option>
                            <option  value="2">Waiting Confirmation</option>
                            <option   value="3">Canceled</option>
                            <option  value="4">Finished</option>
                            </select>

                            @if ($errors->has('meetStatus'))
                            <span class="help-block">
                              <strong>{{ $errors->first('meetStatus') }}</strong>
                          </span>
                          @endif
                      </p>
                  </div>
              </div>


              <div class="form-group{{ $errors->has('$meetingData->meetIdHost') ? ' has-error' : '' }}">
                  <label for="meetIdHost" class="col-md-4 control-label">Host Identification:</label>

                  <div class="col-md-6">
                      <input class="form-control" name="meetIdHost" readonly value="{{$host->username }}" >  </input>                                

                      @if ($errors->has('meetIdHost'))
                      <span class="help-block">
                          <strong>{{ $errors->first('meetIdHost') }}</strong>
                      </span>
                      @endif
                  </div>
              </div>
              <div class="form-group{{ $errors->has('$meetingData->sendmail') ? ' has-error' : '' }}">
                  <label for="sendmail" class="col-md-4 control-label">Send Email: 
                  </label>

                  <div class="col-md-6">
                  @if($meetingData->email==1)
                <p>Email Confirmation Sent</p>
                           @else
                     <p>No Email Sent</p>
                           @endif
                           @if ($errors->has('sendmail'))
                      <span class="help-block">
                          <strong>{{ $errors->first('sendmail') }}</strong>
                      </span>
                      @endif
                  </div>
              </div>
            </div>


                <div class="col-md-4" > 
      <div class="well">
        <dl class="dl-horizontal">
          <dt>Created At:</dt>
          <dd>{{ date('M j, Y h:ia', strtotime($meetingData->created_at)) }}</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Last Updated:</dt>
          <dd>{{ date('M j, Y h:ia', strtotime($meetingData->updated_at)) }}</dd>
        </dl>
        <hr>
        <div class="row">
        
          <div class="col-sm-6">

         
            <button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-floppy-save"></span> Save Changes</button>
           
          </div>
         <div class="col-sm-6">
            <a class="btn btn-danger btn-block"  href="{{ route('meetings.show', $meetingData->idMeeting) }}"><i class="fa fa-close"></i> Cancel</a>
        </div>

      </div>
      </div>
      

          </form>

                </div>
       




   


    @endsection
