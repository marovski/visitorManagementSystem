@extends('main')

@section('title', '| All Delivers')

@section('content')

		<div class="row" >
		<div class="col-md-10">
			<h1>All Deliveries</h1>
		</div>

	<div class="col-md-2">
			<a href="{{ route('delivers.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing"> <span class="glyphicon glyphicon-plus"></span> New Deliver </a>
		</div>
		<div class="col-md-12">
			<hr>
		</div>
	</div> 
	     <!-- end of .row -->
	     <form action="/search/delivers" method="get" role="form">
<div class="input-group custom-search-form col-xs-4">

                                <input type="text" name="q" class="form-control" placeholder="Search..." value="{{ Request::get('q') }}">    <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                              
                          
                      
                            </div>
      </form>
<section class="panel panel-default" >
<i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>


				
		<div class="table-responsive"    >
	
			<table class="table table-striped m-b-none" data-ride="datatables" id="table" >
				<thead>
				
					<th>Firm</th>
					<th>Vehicle</th>
					<th>Driver</th>
					<th>Delivered At</th>
					<th>Finished At</th>
					<th></th>
				</thead>
			
				<tbody >
				
								@foreach($delivers as $deliver)
	
						<tr class="delive" >

							
						
							<td title="{{$deliver->deFirmSupplier }}">{{$deliver->deFirmSupplier }}</td>
							<td title="{{ $deliver->vehicleRegistry}}">{{ $deliver->vehicleRegistry}}</td>
							<td title="{{ $deliver->deDriverName}}">{{ $deliver->deDriverName}}</td>
							
							     <td title="{{date('M j, Y H:i', strtotime($deliver->deEntryTime))}}">{{ ($deliver->deEntryTime ? date('M j, Y H:i', strtotime($deliver->deEntryTime)) : '')  }}</td>
                                     <td title="{{date('M j, Y H:i', strtotime($deliver->deExitTime)) }}">{{ ($deliver->deExitTime ? date('M j, Y H:i', strtotime($deliver->deExitTime)) : '')  }}</td>
						
							<td>
							
								<a class="btn btn-default btn-sm" href="{{ route('delivers.show',$deliver->idDeliver) }}"><span class="glyphicon glyphicon-zoom-in"></span>View</a></td>
								<td>
							
							@if (empty($deliver->deExitTime))
										
					
					<a  href="{{ route('delivers.checkout', $deliver->idDeliver) }}" id="checkOut" onclick="return confirm('Are you certain to proceed to the Check-out process?')" class="btn btn-default btn-sm"   ><i class="fa fa-mail-forward" ></i> Check-out</a>

								@else
					<a disabled readonly id="checkOut"  class="btn btn-default btn-sm"  ><i class="fa fa-mail-forward" ></i> Check-out</a>

											@endif

				</td>
							
						
						
			
							 </td>
						

						</tr>
@endforeach

				</tbody>
					
			</table>

	
			<div class="tedelivert-center">
				{!! $delivers->links(); !!}
			</div>
		</div>
		</section>

@stop
