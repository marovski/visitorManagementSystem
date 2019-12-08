
  @extends('main')
  @section('title','| HomePage')

    @section('content')

      <div class="row">
        <div class="col-md-12">
          <div class="jumbotron">
          <img src="https://amkor.com/wp-content/themes/amkor/dist/images/header-logo.jpg">
            <h4 style="text-align: justify;text-align: center;">Welcome to NANIUM's Guests and Visitors Management System</h4>
          
       
          </div>
        </div>
      </div>
      <!-- end of header .row -->
      @if(!isset($user))
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Login Information</b></div>
                <div class="panel-body">

             <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="password" class="form-control" name="username" required>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                           
                            </div>
                        </div>
                    </form>
             </div>
         </div>
     </div>
 </div>
</div>



            @elseif(($user->fk_idSecurity == 1))
           
            <h4>Your Daily Meetings:</h4>
            <section class="panel panel-default"   ng-controller="showInputController">
          <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
        <div class="table-responsive" >
         <table class="table table-striped m-b-none" data-ride="datatables" id="table">
            <thead>
            <tr>
            <th>Host</th>
            <th>Visitor Company</th>
            <th>Visitor Name</th>
            <th>Meeting</th>
            <th>Sensibility</th>
            <th>Starts At</th>
           <th>Ends At</th>
            <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($hostMeetings as $meet)
  <tr>
            <td><img src="/images/{{ Auth::user()->photo }}" style="width:32px; height:32px;border-radius:50%" title="{{ Auth::user()->username }}"></img></td>
             <td> @if(empty($meet->visitor->first()->visitorName)) @else{{ $meet->visitor->first()->visitorName }}@endif</td>
           <td> @if(empty($meet->visitor->first()->visitorCompanyName)) @else{{ $meet->visitor->first()->visitorCompanyName }}@endif</td>
            <td>{{ $meet->meetingName }}</td>
               <td>@if($meet->sensibility==1) Small @elseif($meet->sensibility==2) Medium @else High @endif</td>
            <td title="{{$meet->meetStartDate}}">{{ $meet->meetStartDate ? date('H:i', strtotime($meet->meetStartDate)) :'' }}</td>
            <td title="{{$meet->meetEndDate}}">{{ $meet->meetEndDate ? date('H:i', strtotime($meet->meetEndDate)) :'' }}</td>
            <td><a href="{{ route('meetings.show', $meet->idMeeting) }}" class="btn btn-primary btn-sm">See More</a></td>
           
                      </tr>
                @endforeach
                 </tbody>
                  </table>
                  <div class="text-center">
              {!! $hostMeetings->links(); !!} 
                   </div>
                  </div>   
                  </section>    
       @elseif(($user->fk_idSecurity == 3))

            <h4>Meetings Scheduled For Today:</h4><hr>
            <section class="panel panel-default"   ng-controller="showInputController">
        <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
      <div class="table-responsive" >
         <table class="table table-striped m-b-none" data-ride="datatables" id="table">
            <thead>
            <tr>
            <th>Host</th>
            <th>Visitor Name</th>
           <th>Visitor Company</th>
            <th>Meeting Name</th>
             <th>Sensibility</th>
            <th>Starts At</th>
            <th>Ends At</th>
            <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($meetings as $meet)
            <tr>
            <td><img src="/images/{{$userPhoto->find($meet->meetIdHost)->photo}}" style="width:32px; height:32px;border-radius:50%" title="{{$userPhoto->find($meet->meetIdHost)->username}}"></img></td>
            
        <td> @if(empty($meet->visitor->first()->visitorName)) @else{{ $meet->visitor->first()->visitorName }}@endif</td>
           <td> @if(empty($meet->visitor->first()->visitorCompanyName)) @else{{ $meet->visitor->first()->visitorCompanyName }}@endif</td>

            <td title="{{$meet->meetingName}}"><h4>{{ substr(strip_tags($meet->meetingName),0,10) }}</h4></td>
            <td>@if($meet->sensibility==1) Small @elseif($meet->sensibility==2) Medium @else High @endif</td>
            <td title="{{$meet->meetStartDate}}">{{$meet->meetStartDate? date('H:i', strtotime($meet->meetStartDate)) : '' }}</td>
            <td title="{{$meet->meetEndDate}}">{{ $meet->meetEndDate ? date('H:i', strtotime($meet->meetEndDate)) :'' }}</td>
            <td><a href="{{ route('meetings.show', $meet->idMeeting) }}" class="btn btn-primary btn-sm">See More</a></td>
            

                 </tr>
                @endforeach
                </tbody>
            </table>

                <div class="text-center">
                {!! $meetings->links(); !!}
            </div>
             </div>
             </section>
         


         
<hr><br>
<h4>Last delivers:</h4><hr>
    <table class="table table-striped m-b-none" data-ride="datatables" id="table">
            <thead>
            <tr>
            <th>Firm</th>
            <th>Vehicle</th>
            <th>Driver</th>
            <th>Delivered at</th>
            <th></th>
            </tr>
            </thead>
            <tbody>              
@foreach($delivers as $deliver)
             <tr>
            <td title="{{$deliver->deFirmSupplier}}">{{strlen($deliver->deFirmSupplier) > 10 ? substr($deliver->deFirmSupplier,0,10)."..." : "$deliver->deFirmSupplier" }}</td>
            <td title="{{$deliver->vehicleRegistry}}">{{strlen($deliver->vehicleRegistry) > 10 ? substr($deliver->vehicleRegistry,0,10)."..." : "$deliver->vehicleRegistry" }}</td>
            <td title="{{$deliver->deDriverName}}">{{ strlen($deliver->deDriverName) > 10 ? substr($deliver->deDriverName,0,10)."..." : $deliver->deDriverName}}</td>
            <td title="{{$deliver->deEntryTime}}">{{ date('M j, Y H:i', strtotime($deliver->deEntryTime)) }}</td>
            <td><a href="{{ route('delivers.show', $deliver->idDeliver) }}" class="btn btn-primary btn-sm">See More</a></td>
           
                @endforeach
            </tr>
            </tbody>
            </table>


<hr><br>
<h4>Last drops:</h4><hr>
        <table class="table table-striped m-b-none" data-ride="datatables" id="table">
            <thead>
            <tr>
            <th>Dropper Name</th>
            <th>Dropper Company</th>
            <th>Drop importance</th>
            <th>Dropped when</th>
           
            <th></th>
            </tr>
            </thead>
            <tbody>          
@foreach($drops as $drop)
 <tr>
               <td title="{{ $drop->dropperName }}">{{ $drop->dropperName }}</td>
          
            <td title="{{ $drop->dropperCompanyName }}">{{ $drop->dropperCompanyName }}</td>
            <td title="{{ $drop->dropImportance }}">@if($drop->dropImportance==1)
                       Low
                       @elseif($drop->dropImportance==2)
                       Medium
                       @else
                       High
                       @endif</td>
                         <td title="{{ $drop->droppedWhen }}">{{ date('M j, Y H:i', strtotime($drop->droppedWhen)) }}</td>
            <td><a href="{{ route('drops.show', $drop->idDrop) }}" class="btn btn-primary btn-sm">See More</a></td>
          
                @endforeach
                </tr>
            </tbody>
            </table>
                @endif
       
@endsection
  