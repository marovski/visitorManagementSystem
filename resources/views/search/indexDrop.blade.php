@extends('main')

@section('title', '| Search Drops Results')

@section('content')

	<div class="container">
     
    <div class="row">
       <div class="col-md-8 col-md-offset-2">
             
        <div class="panel panel-default">
    
              <div class="panel-heading">Search Results for "{{ Request::get('q') }}"</div>

              <div class="panel-body">
                  

              @if($drops->count())

              

          <div class="well">
          @foreach($drops as $drop)
              <div class="media">
              <div class="media-left">
                  <table class="table">
              <thead>
                           <tr>
                            <th width="">Company Name</th>
                            <th width="">Dropper Name</th> 
                            <th width="">Receiver Name</th>
                            <th width="">Drop Item</th>
                            <th width="">Dropped at</th>
                            <th width="">Received at</th>
                            <th></th>
                        </tr>
                    </thead>
              <tbody>
            
                  <tr class="success">
                  <td>{{ $drop->dropperCompanyName }}</td>
                                <td>{{ $drop->dropperName }}</td>
                                <td>{{ $drop->dropReceiver }}</td>
                                <td>{{ $drop->dropDescr }}</td>
                                <td>{{ date('M j, Y H:i', strtotime($drop->droppedWhen)) }}</td>
                                <td>{{ $drop->dropReceivedDate ? date('M j, Y H:i', strtotime($drop->dropReceivedDate)) : '' }}</td>
                                <td>
                              
                                <a href="{{ route('drops.show',$drop->idDrop) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> View</a>
                                        </td>
                                        <td>
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