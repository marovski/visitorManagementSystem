@extends('main')

@section('title', '| Search Delivers Results')

@section('content')

	<div class="container">
     
    <div class="row">
       <div class="col-md-8 col-md-offset-2">
             
        <div class="panel panel-default">
    
              <div class="panel-heading">Search Results for "{{ Request::get('q') }}"</div>

              <div class="panel-body">
                  

              @if($delivers->count())

              

          <div class="well">
          @foreach($delivers as $deliver)
              <div class="media">
              <div class="media-left">
                  <table class="table">
              <thead>
                <tr>
                  <th>Firm Supplier</th>
                  <th>Driver Name</th>
                  <th>Vehicle Registry</th>
                  <th>Start Date</th>
                   <th>End Date</th>
                 <th></th>

                </tr>
              </thead>
              <tbody>
            
                  <tr class="success">
                  <td>{{ $deliver->deFirmSupplier }}</td>
                  <td>{{ $deliver->deDriverName }}</td>
                  <td>{{$deliver->vehicleRegistry}}</td>
                  <td>{{ $deliver->deEntryTime ? date('M j, Y H:i', strtotime($deliver->deEntryTime)) : '' }}</td>
                     <td>{{ $deliver->deExitTime ? date('M j, Y H:i', strtotime($deliver->deExitTime)) : '' }}</td>
                       <td> <a href="{{ route('delivers.show', $deliver->idDeliver) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> View</a> </td>
                </tr>
       
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