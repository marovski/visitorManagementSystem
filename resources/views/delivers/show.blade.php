@extends('main')

@section('title', '| View Deliver')

@section('content')

	<div class="row">
		<div class="col-md-8" style="width: 71.666667%;">
		<table class="table">
          <thead>
            <tr>
              <th>Firm Supplier</th>
              <th>Driver Name</th>
              <th>Vehicle License</th>
              <th>Entry Weight</th>
              <th>Exit Weight</th>
                <th>Entry Time</th>
              <th>Exit Time</th>
      
            </tr>
          </thead>

          <tbody>
            
            <tr>
              <td>{!! $deliver->deFirmSupplier !!}</td>
              <td>{{ $deliver->deDriverName }}</td>
              <td>{{ $deliver->vehicleRegistry }}</td>
              <td>{{ $deliver->entryWeight }}</td>
			  <td>{{ $deliver->exitWeight }}</td>
			  	<th>{{ $deliver->deEntryTime }}</th>
							<th>{{ $deliver->deExitTime }}</th>
               </tr>

          </tbody>
        </table>
    
			
			<div id="backend-comments" style="margin-top: 50px;">
				<h3>Cargo <small>{{ $deliver->type()->count() }} total</small> @if(empty($deliver->deEntryTime))<a href="{{ route('deliveryType.createDeliveryType', $deliver->idDeliver)}}" class="btn btn-xs btn-success"> <span class="glyphicon glyphicon-plus"></span></a>@else <a   style="pointer-events: none;cursor: default;" class="btn btn-xs btn-success"> <span class="glyphicon glyphicon-plus"></span></a>@endif</h3>

				<table class="table">
					<thead>
						<tr>
							<th>Content</th>
							<th>Danger</th>
							<th>Caution</th>
							<th>Quantitity</th>
						
						
							<th width="70px"></th>
						</tr>
					</thead>

					<tbody>
						@foreach ($deliver->type as $items)
				
						<tr>
							<td> <span class="label label-default">{{ $items->materialDetails }}</span></td>
					
							<td>
								@if ($items->dangerousGood === 1) 
                                      {{ 'Danger' }}
                                    @elseif ($items->dangerousGood === 0) 
                                        {{ 'Not Danger' }}
                                    
                                     @endif

							</td>
									<td>
									@if ($items->sensitiveLevel === 1)
									{{ 'Low' }}
									@elseif($items->sensitiveLevel === 2)
									{{ 'Medium' }}
									@elseif ($items->sensitiveLevel === 3)
									 {{ 'High' }}
									@endif
									</td>
							<th>{{ $items->quantity}}</th>
						
							
							<td>
								<a href="{{ route('deliveryType.edit', $items->idDeliverType) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="{{ route('deliveryType.destroy', $items->idDeliverType) }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
					
						@endforeach
					</tbody>
				</table>
			</div>

		</div>

		<div class="col-md-4" style=" width: 27.333333%;">
			<div class="well">
				

				<dl class="dl-horizontal">
					<label>Created At:</label>
					<p>{{ date('M j, Y h:ia', strtotime($deliver->created_at)) }}</p>
				</dl>

				<dl class="dl-horizontal">
					<label>Last Updated:</label>
					<p>{{ date('M j, Y h:ia', strtotime($deliver->updated_at)) }}</p>
				</dl>
				<hr>
				<div class="row">
				
					<div class="col-sm-12">
						{!! Form::open(['route' => ['delivers.destroy', $deliver->idDeliver], 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()']) !!}

						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

						{!! Form::close() !!}
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						{{ Html::linkRoute('delivers.index', '<< See All Deliveries', array(), ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
					</div>
				</div>

			</div>
		</div>
	</div>

@endsection