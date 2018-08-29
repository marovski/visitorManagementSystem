
  @extends('main')

  @section('title', '| Edit Delivery')

  @section('assets')
  <link rel='stylesheet' href='/css/parsley.css' />
  @endsection

  @section('content')
  
      <div class="row"  >

         

<div class="panel-heading"><span class="glyphicon glyphicon-blackboard"></span> Edit Delivery</div>



  {!! Form::model($deliveryData,['route' => ['delivers.update', $deliveryData->idDeliver], 'method' => 'PUT','class' => 'form-horizontal','data-parsley-validate' => '', 'files' => true]) !!}
    {{-- {!! Form::model($deliveryData, ['route' => ['delivers.update', $deliveryData->idDeliver], 'method' => 'PUT']) !!} --}}
   
      {{ csrf_field() }}

                        
 <div class="col-md-8">
                        

                     

                        

          <div class="form-group{{ $errors->has('driverName') ? ' has-error' : '' }}">
            <label for="driverName" class="col-md-4 control-label">Driver Name:</label>

            <div class="col-md-6">
              <input id="driverName" type="text" class="form-control" name="driverName" value="{{ $deliveryData->deDriverName }}" required autofocus>

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
              <input id="vehicleLicensePlate" type="text" class="form-control" name="vehicleLicensePlate" value="{{ $deliveryData->vehicleRegistry }}" required >

              @if ($errors->has('vehicleLicensePlate'))
              <span class="help-block">
                <strong>{{ $errors->first('vehicleLicensePlate') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('firm') ? ' has-error' : '' }}">
            <label for="firm" class="col-md-4 control-label">Firm Supplier:</label>

            <div class="col-md-6">
              <input id="firm" type="text" class="form-control" name="firm" value="{{ $deliveryData->deFirmSupplier }}" required autofocus>

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
              <input type="number"  name="weight"   min="0" placeholder="Kg" value="{{ $deliveryData->entryWeight }}">

                                     

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
              <input type="number"  name="exitweight"   min="0" placeholder="Kg" value="{{ $deliveryData->exitWeight }}">

                                     

            @if ($errors->has('exitweight'))
            <span class="help-block">
              <strong>{{ $errors->first('exitweight') }}</strong>
            </span>
            @endif
          </div>
        </div>


      
          <div class="form-group">
          <label for="image" class="col-md-4 control-label" >Image Upload:</label>
          <div class="col-md-6">
          <input type="file" class="form-control" />
            
          </div>
        </div>
         <div class="form-group{{ $errors->has('deEntryTime') ? ' has-error' : '' }}">
                            <label for="deEntryTime" class="col-md-4 control-label">Entry Time:</label>

                            <div class="col-md-6">
                                <input id="deEntryTime" type="text" class="form-control" name="deEntryTime" value= '{{$deliveryData->deEntryTime}}' disabled autofocus>

                                @if ($errors->has('deEntryTime'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('deEntryTime') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                        </div>
                        
                        <div class="form-group{{ $errors->has('deExitTime') ? ' has-error' : '' }}">
                            <label for="deExitTime" class="col-md-4 control-label">Exit Time:</label>

                            <div class="col-md-6">
                                <input id="deExitTime" type="text" class="form-control" name="deExitTime" value= '{{ $deliveryData->deExitTime}}' disabled autofocus>

                                @if ($errors->has('deExitTime'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('deExitTime') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                        </div>

           
          </div>


  <div class="col-md-4" > 
    <div class="well">
      <dl class="dl-horizontal">
        <dt>Created At:</dt>
        <dd>{{ date('M j, Y h:ia', strtotime($deliveryData->created_at)) }}</dd>
      </dl>

      <dl class="dl-horizontal">
        <dt>Last Updated:</dt>
        <dd>{{ date('M j, Y h:ia', strtotime($deliveryData->updated_at)) }}</dd>
      </dl>
      <hr>
      <div class="row">
      <div class="col-sm-6">
        <button type="submit" class="btn btn-primary btn-block" onclick="return confirm('Are you certain to save this edit?')" ><span class="glyphicon glyphicon-floppy-save"></span> Save Changes</button>
           
        </div>
        <div class="col-sm-6">

        <a class="btn btn-danger btn-block"  href="{{ route('delivers.show', $deliveryData->idDeliver) }}"><i class="fa fa-close"></i>Cancel</a> </div>
        
      </div>

    </div>
    </div>
    
{!! Form::close() !!}

              </div><!-- end of .row (form) -->
     
 


  @endsection
