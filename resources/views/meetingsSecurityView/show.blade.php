@extends('main')

@section('title', '| View Meeting')

@section('content')

  <div class="row">
    <div class="col-md-8" style="width: 68.666667%;">
      <table class="table">
          <thead>
            <tr>
              <th>Topic</th>
              <th>Confidentiality</th>
              <th>Sensibility</th>
              <th>Escorted Visitors</th>
              <th width="100px"></th>
            </tr>
          </thead>

          <tbody>
            
            <tr>
              <td>{{ $meetingData->meetingName }}</td>
              <td>@if($meetingData->confidentiality==1) Top Secret @else Unclassified @endif</td>
              <td>@if($meetingData->sensibility==1) Small @elseif($meetingData->sensibility==2) Medium @else High @endif</td>
              <td><span class="label label-default">{{$meetingData->visitor->where('escorted', 1)->count()}} </span></td>
              </td>
            </tr>

          </tbody>
        </table>
     <div id="visitors" style="margin-top: 50px;">
        <h4><b>Internal Visitors</b> <small>{{ $meetingData->user()->count() }} total   </small></h4>
  
        </hr> 

        <table class="table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Department</th>
           
              <th width="70px"></th>
            </tr>
          </thead>

          <tbody>
            @foreach ($meetingData->user as $visitorInt)
            <tr>
              <td>{{ $visitorInt->username }}</td>
              <td>{{ $visitorInt->email }}</td>
               <td>{{ $visitorInt->department }}</td>
              
              
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <hr>
      <div id="visitors" style="margin-top: 50px; ">
          <h4><b>External Visitors</b> <small>{{ $meetingData->visitor()->count() }} total   </small></h4>

        
         
<div class="table-responsive">
        <table class="table" style="white-space:nowrap;">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Company</th>
              <th>ID Number</th>
               <th>Arrival</th>
              <th >Departure</th>
              <th ></th>
            </tr>
          </thead>

          <tbody>
            @foreach ($meetingData->visitor as $visitorEx)

            <tr>
              <td>@if($visitorEx->entryTime==null)<a alt="Edit" href="{{ route('visitors.edit', $visitorEx->idVisitor)}}">{{ $visitorEx->visitorName }}</a>@else {{ $visitorEx->visitorName }} @endif </td>
              <td>{{ $visitorEx->visitorEmail }}</td>
              <td>{{ $visitorEx->visitorCompanyName }}</td>
              <td>{{ $visitorEx->visitorCitizenCard }}</td>
              <td> {{ $visitorEx->entryTime }}</td>
              <td>{{ $visitorEx->exitTime }}</td>
              
              <td> 
                 <a href="{{ route('visitors.show', $visitorEx->idVisitor)}}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-zoom-in"></span></a> </td>
                 <td>
                                 @if(!empty($visitorEx->entryTime))
                                 <button alt="checkin" class="btn btn-default btn-sm" disabled="true"><i class="fa fa-map-marker"></i></button> 
                                 @else 
                                  {!! Form::open(array('action' => array('VisitorController@checkin', $visitorEx->idVisitor))) !!}
                              
                               <button alt="checkin"  type="submit" class="btn btn-default btn-sm"><i class="fa fa-map-marker"></i></button>
                              
                                {!! Form::close() !!}
                                @endif
                                </td>
                                <td>
                                  @if(!empty($visitorEx->exitTime))<button class="btn btn-default btn-sm" disabled="true"><i class="fa fa-mail-forward"></i></button> 
                                @else 
                                {!! Form::open(array('action' => array('VisitorController@checkout', $visitorEx->idVisitor))) !!}
                              
                             <button alt="checkout" type="submit" class="btn btn-default btn-sm"><i class="fa fa-mail-forward" ></i></button>
                                {!! Form::close() !!}

                                @endif
                          
</td>
               <td>
           @if(empty($visitorEx->entryTime))
                <a  style="height: 30px;
    margin-top: 0px;" href="{{ route('visitors.badge',$visitorEx->idVisitor) }}" class="btn btn-xs btn-icon btn-success"><span class="glyphicon glyphicon-print"></span></a>
           @else
  <a  style="height: 30px;margin-top: 0px; pointer-events: none;cursor: default;"  class="btn btn-xs btn-icon btn-success"><span class="glyphicon glyphicon-print" disabled="true"></span></a>
            @endif

              </td>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>
      </div>

     
       

  </div>

       

    <div class="col-md-4" style="width: 23.333333%;
    margin-left: 90px;" >
      <div class="well">
     

        <dl class="dl-horizontal">
         <label>Start at:</label>
          <p>{{ ($meetingData->meetStartDate ? date('M j, Y h:ia', strtotime($meetingData->meetStartDate)) : '')  }}</p>
        </dl>

        <dl class="dl-horizontal">
          <label>End Date:</label>
          <p>{{ ($meetingData->meetEndDate ? date('M j, Y h:ia', strtotime($meetingData->meetEndDate)) : '')  }}</p>
        </dl>
        <hr>
        <div class="row">
        <div class="form-group">
        <div class="col-md-12">


             <a href="{{ route('meetings.edit', $meetingData->idMeeting) }}" class="btn btn-primary btn-block">Edit</a> 
        
            
          </div>



 <div class="col-md-12">
          <a href="{{ route('meetings.index') }}" class="btn btn-default btn-block btn-h1-spacing"> << See All Meetings</a> 
        
            
          </div>
          </div>
          
         
       

           
        </div>

       

      </div>
  
  </div>
  </div>

@endsection
