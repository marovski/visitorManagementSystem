@extends('main')

	@section('title', '| Deliver Check-out')

	@section('assets')
	<link rel='stylesheet' href='/css/parsley.css' />
	@endsection

	@section('content')

	<div class="row">

		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Deliver Check-out</div>
				<div class="panel-body"> 
					{!! Form::model($deliver, array('method'=>'post','class'=>'form-horizontal', 'role'=> 'form', 'route' => array('delivers.checkoutUpdate', $deliver->idDeliver))) !!}

						<div class="form-group{{ $errors->has('driverName') ? ' has-error' : '' }}">
							<label for="driverName" class="col-md-4 control-label">Driver Name:</label>

							<div class="col-md-6">
								<input id="driverName" type="text" class="form-control" name="driverName" readonly="" disabled="" value="{{ $deliver->deDriverName}}">

								@if ($errors->has('driverName'))
								<span class="help-block">
									<strong>{{ $errors->first('driverName') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('vehicleLicensePlate') ? ' has-error' : '' }}">
							<label for="vehicleLicensePlate" class="col-md-4 control-label">Vehicle License Plate:</label>
							<div class="col-md-6">
								<input id="vehicleLicensePlate" type="text" class="form-control" name="vehicleLicensePlate" value="{{ $deliver->vehicleRegistry }}"  data-parsley-pattern="(^(?:[A-Z]{2}-\d{2}-\d{2})|(?:\d{2}-[A-Z]{2}-\d{2})|(?:\d{2}-\d{2}-[A-Z]{2})$)" max-lenght="50" readonly="" disabled="">

								@if ($errors->has('vehicleLicensePlate'))
								<span class="help-block">
									<strong>{{ $errors->first('vehicleLicensePlate') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('dropperName') ? ' has-error' : '' }}">
							<label for="firm" class="col-md-4 control-label">Firm Supplier:</label>

							<div class="col-md-6">
								<input id="firm" type="text" class="form-control" name="firm" readonly="" disabled=""  value="{{ $deliver->deFirmSupplier }}">

								@if ($errors->has('firm'))
								<span class="help-block">
									<strong>{{ $errors->first('firm') }}</strong>
								</span>
								@endif
							</div>
						</div>


						<div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
							<label for="cargo" class="col-md-4 control-label">Cargo Details:</label>

							<div class="col-md-6">
							@if(empty($type))
						<input id="cargo" type="text"  readonly=""  class="form-control" name="cargo" value="No Cargo">

							@else
								<input id="cargo" type="text"  readonly=""  class="form-control" name="cargo" value="{{ $type->materialDetails }}">
								@endif
								@if ($errors->has('cargo'))
								<span class="help-block">
									<strong>{{ $errors->first('cargo') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('danger') ? ' has-error' : '' }}">
							<label for="danger" class="col-md-4 control-label">Dangerous Cargo:</label>

							<div class="col-md-6" >
								<p>
								@if(!empty($type))
								@if($type->dangerousGood==1)
									<label class="radio-inline"><input type="radio" name="danger" readonly="" disabled="" value="1" > Danger Materials</label>								@else
										<label class="radio-inline"><input type="radio" name="danger" readonly="" disabled="" value="0" > No Danger Materials</label>
									@endif	

									@if ($errors->has('danger'))
									<span class="help-block">
										<strong>{{ $errors->first('danger') }}</strong>
									</span>
									@endif
									@else
									<p>No Cargo</p>

									@endif
								</p>
							</div>
						</div>

						<div class="form-group{{ $errors->has('sensitivity') ? ' has-error' : '' }}">
							<label for="sensitivity" class="col-md-4 control-label"> Sensitivity Level (select one):</label>

							<div class="col-md-6">
								<select class="form-control" id="sensitivity" readonly="" disabled="" >
									@if(!empty($type))
								@if($type->sensitiveLevel==1)
									<option value="" >Low</option>
									@elseif($deliver->sensitiveLevel==2)
									<option value="">Medium</option>
									@elseif($deliver->sensitiveLevel==3)
									<option value="">High</option>
									@endif
									@else
									<option>No Cargo</option>>

									@endif
								</select>                               

								@if ($errors->has('sensitivity'))
								<span class="help-block">
									<strong>{{ $errors->first('sensitivity') }}</strong>
								</span>
								@endif
								
							</div>
						</div>
						<div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}" >
							<label for="weight" class="col-md-4 control-label">Entry Weight (Kg):</label>

							<div class="col-md-6">
								<input type="number"  name="weight" readonly="" disabled=""  min="0" placeholder="Kg" value="{{ $deliver->entryWeight}}">

							</select>                               

							@if ($errors->has('weight'))
							<span class="help-block">
								<strong>{{ $errors->first('weight') }}</strong>
							</span>
							@endif
						</div>
					</div>
						<div class="form-group{{ $errors->has('exitweight') ? ' has-error' : '' }}" >
							<label for="exitweight" class="col-md-4 control-label">Exit Weight (Kg):</label>

							<div class="col-md-6">
								<input type="number"  name="exitweight"  min="0" placeholder="Kg" value="{{ $deliver->exitWeight}}">

							</select>                               

							@if ($errors->has('exitweight'))
							<span class="help-block">
								<strong>{{ $errors->first('exitweight') }}</strong>
							</span>
							@endif
						</div>
					</div>

						<div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}" >
							<label for="quantity" class="col-md-4 control-label">Entry Quantity (per unity):</label>

							<div class="col-md-6">
							@if(!empty($type))
						<input type="number" readonly="" disabled="" name="quantity" min="1" placeholder="" value="{{ $deliver->deQuantity}}">
							@else
									<input type="number" readonly="" disabled="" name="quantity" min="1" placeholder="" value="">
									@endif
							</select>                               

							@if ($errors->has('quantity'))
							<span class="help-block">
								<strong>{{ $errors->first('quantity') }}</strong>
							</span>
							@endif
						</div>
					</div>
									
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4" >
							<button type="submit" class="btn btn-basic btn-sm btn-block">
								Check-out
							</button>
							<a href="{{ route('delivers.index') }}" class="btn btn-default btn-sm btn-block">Cancel</a>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection
