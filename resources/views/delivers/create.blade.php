@extends('main')

	@section('title', '| Create New Deliver')

	@section('assets')
	<link rel='stylesheet' href='/css/parsley.css' />
	@endsection

	@section('content')

	<div class="row" ng-app="MyApp" >

		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span> Create Delivery</div>
				<div class="panel-body"  ng-controller="showInputController"> 
							

			  <form class="form-horizontal" role="form" method="POST" action="{{ route('delivers.store') }}" enctype="multipart/form-data" >
				{{ csrf_field() }}

						<div class="form-group{{ $errors->has('driverName') ? ' has-error' : '' }}">
							<label for="driverName" class="col-md-4 control-label"><span class="after">*</span> Driver Name:</label>

							<div class="col-md-6">
								<input id="driverName" type="text" class="driverName form-control" data-provide="driverName" name="driverName" value="{{ old('driverName') }}" placeholder='Type here the driver name' required autofocus ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()">

								@if ($errors->has('driverName'))
								<span class="help-block">
									<strong>{{ $errors->first('driverName') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('driverIDType') ? ' has-error' : '' }}"  >
							<label for="driverIDType" class="col-md-4 control-label"><span class="after">*</span> Identification Card Type:</label>

							<div class="col-md-6">
								<select class="form-control" id="driverIDType" name="driverIDType" ng-model="driverIDType" >
									<option value="1" >Passport</option>
									<option value="2" >Citizen Card</option>
									<option value="3" >Driver License</option>

								</select>

								@if ($errors->has('driverIDType'))
								<span class="help-block">
									<strong>{{ $errors->first('driverIDType') }}</strong>
								</span>
								@endif
							</div>
						</div>


						<div ng-show="driverIDType != 0" class="form-group{{ $errors->has('driverID') ? ' has-error' : '' }}"   >
							<label for="driverID" class="col-md-4 control-label"><span class="after">*</span> Identification Card Number:</label>

							<div class="col-md-6">
								<input id="driverID"  type="text" class="form-control" name="driverID" value="{{ old('driverID') }}" placeholder='Type here the id card number' required autofocus ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()" >

								@if ($errors->has('driverID'))
								<span class="help-block">
									<strong>{{ $errors->first('driverID') }}</strong>
								</span>
								@endif
							</div>
						</div>

			

						<div class="form-group{{ $errors->has('vehicleLicensePlate') ? ' has-error' : '' }}">
							<label for="vehicleLicensePlate" class="col-md-4 control-label">Vehicle License Plate:</label>

							<div class="col-md-6">
								<input id="vehicleLicensePlate" type="text" class="vehicleLicensePlate form-control" data-provide="vehicleLicensePlate" name="vehicleLicensePlate" value="{{ old('vehicleLicensePlate') }}" required autofocus  max-lenght="40" placeholder='ex.PT:00-AA-00'>

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
								<input id="firm" type="text" class="firm form-control" data-provide="firm" name="firm" value="{{ old('firm') }}" required autofocus placeholder='Type here the firm supplier' ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()">

								@if ($errors->has('firm'))
								<span class="help-block">
									<strong>{{ $errors->first('firm') }}</strong>
								</span>
								@endif
							</div>
						</div>


						
						<div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}" >
							<label for="weight" class="col-md-4 control-label">Entry Weight (Kg):</label>

							<div class="col-md-6">

								<input type="number"  name="weight"  min="0" placeholder="Kg"  ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()">

                            

							@if ($errors->has('weight'))
							<span class="help-block">
								<strong>{{ $errors->first('weight') }}</strong>
							</span>
							@endif
						</div>
					</div>

					
				
						<div class="form-group">
						<label for="image" class="col-md-4 control-label" >Image Upload:</label>
						<div class="col-md-6">
						<input name="image" id="image" type="file" class="form-control" />
							
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4" >
							<button type="submit" class="btn btn-basic btn-sm btn-block" onclick="return confirm('Are you certain to create this delivery?')">
								Save Delivery
							</button>
							<a href="{{ route('delivers.index') }}" class="btn btn-default btn-sm btn-block">Cancel</a>
						</div>
					</div>
				</form>



			</div>
		</div>
	</div>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="/js/parsley.min.js"></script>
@endsection