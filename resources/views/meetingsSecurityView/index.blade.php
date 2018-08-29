@extends('main')

@section('title', '| All Meetings')
@section('assets')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>  

@endsection

@section('content')
<div class="container" ng-app="MyApp" >
    <div class="row">
        <div class="col-md-10">
            <h1>All Meetings</h1>
        </div>
            <div class="col-md-2">
         
        </div>
      <div class="col-md-12">
      <hr>
    </div>
<!-- end of .row -->
</div>


<form action="/search" method="get" role="form">
<div class="input-group custom-search-form col-xs-4">

                                <input type="text" name="q" class="form-control " style="position: absolute;" placeholder="Search..." value="{{ Request::get('q') }}">    <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                              
                          
                      
                            </div>
      </form>

<section class="panel panel-default"   ng-controller="showInputController">
<i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>

 
     <div class="table-responsive" >

                <table class="table table-striped m-b-none" data-ride="datatables" id="table">
                    <thead>
                        <tr>  
                               <th width="">Host</th>
                        <th width="">Visitor Company</th>
                        <th width="">Visitor Name</th>
                         <th width="">Meeting Name</th>
                            <th width="">Sensibility</th>
            
                           
                            <th width="">Status</th>
                     

                            <th width="">Start </th>
                              
                               <th width="">Ended </th>
                             
                        </tr>
                    </thead>

                    <tbody>
                     @foreach($meetings as $meeting )
 
                            <tr>
                             <td>{{$user->find($meeting->meetIdHost)->username}}</td>
                            <td> @if(empty($meeting->visitor->first()->visitorCompanyName)) @else{{ $meeting->visitor->first()->visitorCompanyName }}@endif</td>
                              <td>@if(empty($meeting->visitor->first()->visitorName)) @else{{ $meeting->visitor->first()->visitorName }}@endif</td>
                             <td>{{ $meeting->meetingName }}</td>
                             

                                  <td>@if($meeting->sensibility==1) Small @elseif($meeting->sensibility==2) Medium @else High @endif</td>
                          
                                <td> @if ($meeting->meetStatus == 1) 
                                      {{ 'Scheduled' }}
                                    @elseif ($meeting->meetStatus == 2) 
                                        {{ 'Started' }}
                                    
                                    @elseif ($meeting->meetStatus ==3) 
                                        {{ 'Canceled' }}
                                    
                                     @elseif ($meeting->meetStatus == 4) 
                                        {{ 'Finished' }}
                                     @endif</td>
                                 
                               
                         
                                <td>{{ $meeting->meetStartDate ? date('M j, Y H:i', strtotime($meeting->meetStartDate)) : '' }}</td>
                                 <td>{{ $meeting->meetEndDate ?date('M j, Y H:i', strtotime($meeting->meetEndDate)) : '' }}</td>
                               
                                    <td>
                                <a href="{{ route('meetings.show', $meeting->idMeeting) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> View</a> 
                                </td>
                             
                                
                        </tr>
               
                    @endforeach

                </tbody>
            </table>
            <div class="text-center">
                {!! $meetings->links(); !!}
            </div>
        
        </div>
        </section>
    
    </div>
@stop

