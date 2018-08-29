@extends('main')

@section('title', '| Search Meetings Results')

@section('content')

	<div class="container">
     
    <div class="row">
       <div class="col-md-8 col-md-offset-2">
             
        <div class="panel panel-default">
    
              <div class="panel-heading">Search Results for "{{ Request::get('q') }}"</div>

              <div class="panel-body">
                  

              @if($meetings->count())

              

          <div class="well">
          @foreach($meetings as $meeting)
              <div class="media">
              <div class="media-left">
                  <table class="table">
              <thead>
                <tr>
                  <th>Meeting Name</th>
                  <th>Visit Reason</th>
                  <th>Host</th>
                  <th>Start Date</th>
                   <th>End Date</th>
                 <th></th>

                </tr>
              </thead>
              <tbody>
              @if(Auth::user()->idUser == $meeting->meetIdHost)
                  <tr class="success">
                  <td>{{ $meeting->meetingName }}</td>
                  <td>{{ $meeting->visitReason }}</td>
                  <td>{{$user->find($meeting->meetIdHost)->username}}</td>
                  <td>{{ date('M j, Y H:i', strtotime($meeting->meetStartDate)) }}</td>
                     <td>{{ date('M j, Y H:i', strtotime($meeting->meetEndDate)) }}</td>
                       <td> <a href="{{ route('meetings.show', $meeting->idMeeting) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> View</a> </td>
                </tr>

                @else
                    <tr class="info">
                  <td>{{ $meeting->meetingName }}</td>
                  <td>{{ $meeting->visitReason }}</td>
                  <td>{{$user->find($meeting->meetIdHost)->username}}</td>
                  <td>{{ date('M j, Y H:i', strtotime($meeting->meetStartDate)) }}</td>
                     <td>{{ date('M j, Y H:i', strtotime($meeting->meetEndDate)) }}</td>
                       <td> <a href="{{ route('meetings.show', $meeting->idMeeting) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> View</a> </td>
                </tr>
              @endif
              </tbody>
            </table>

              </div>
                  

              </div>
              @endforeach

          </div>
          @else
          No Results
          @endif



              </div>
                 </div>
                   </div>
                     </div>   
                        </div>
@stop