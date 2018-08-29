@extends('main')

@section('title', '| Search Lost Items Results')

@section('content')

	<div class="container">
     
    <div class="row">
       <div class="col-md-8 col-md-offset-2">
             
        <div class="panel panel-default">
    
              <div class="panel-heading">Search Results for "{{ Request::get('q') }}"</div>

              <div class="panel-body">
                  

              @if($lostItems->count())

              

          <div class="well">
          @foreach($lostItems as $item)
              <div class="media">
              <div class="media-left">
                  <table class="table">
              <thead>
                        <tr>
                            <th width="">Finder Name</th>
                            <th width="">Finder Phone</th>
                            <th width="">Item Description</th>
                            <th width="">Receiver Name</th>
                            <th width="">Claimed at</th>
                            <th></th>
                        </tr>
                    </thead>
              <tbody>
            
                  <tr class="success">
                  <td>{{ $item->finderName }}</td>
                  <td>{{ $item->finderPhone }}</td>
                  <td>{{$item->itemDescription}}</td>

                      <td>{{ $item->receiverName }}</td>
                                <td>{{ $item->claimedDate ? date('M j, Y H:i', strtotime($item->claimedDate)) : '' }}</td>
                                <td>

                                     <a href="{{ route('losts.show',$item->idLostFound) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> View</a>
                                     </td>
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