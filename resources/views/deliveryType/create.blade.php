            
   
    @extends('main')

    @section('title', '| Create Delivery Type')

    @section('assets')
    <link rel='stylesheet' href='/css/parsley.css' />
    @endsection

    @section('content')
    
     <div class="row" ng-app="MyApp" >

    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">

           
                    <div class="panel-heading"><span class="glyphicon glyphicon-blackboard"></span> Create Delivery Type</div>
                    <div class="panel-body"  ng-controller="showInputController"> 




      <form class="form-horizontal" role="form" method="POST" action="{{ route('deliveryType.store') }}"  >  
                     {{ csrf_field() }}

                   

            <input id="idDeliver" type="number" class="ng-hide" name="idDeliver" value="{{ $deliver->idDeliver }}"  >
              <div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
              <label for="cargo" class="col-md-4 control-label"><span class="after">*</span> Cargo Details:</label>

              <div class="col-md-6">
                <input id="cargo" type="text" class="form-control" name="cargo" required >

                @if ($errors->has('cargo'))
                <span class="help-block">
                  <strong>{{ $errors->first('cargo') }}</strong>
                </span>
                @endif
              </div>
            </div>
            
            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}" >
              <label for="quantity" class="col-md-4 control-label"><span class="after">*</span> Quantity (per unity):</label>

              <div class="col-md-6">
                <input type="number" name="quantity"  min="0" placeholder="">

                                          

              @if ($errors->has('quantity'))
              <span class="help-block">
                <strong>{{ $errors->first('quantity') }}</strong>
              </span>
              @endif
            </div>
          </div>

            <div class="form-group{{ $errors->has('danger') ? ' has-error' : '' }}">
              <label for="danger" class="col-md-4 control-label"><span class="after">*</span>  Dangerous Cargo:</label>

              <div class="col-md-6" >
                <p>

                  <label class="radio-inline"><input type="radio" name="danger" value="1">Yes</label>
                  <label class="radio-inline"><input type="radio" name="danger" value="0">No</label>

                  @if ($errors->has('danger'))
                  <span class="help-block">
                    <strong>{{ $errors->first('danger') }}</strong>
                  </span>
                  @endif
                </p>
              </div>
            </div>

            <div class="form-group{{ $errors->has('sensitivity') ? ' has-error' : '' }}">
              <label for="sensitivity" class="col-md-4 control-label"> Sensitivity Level (select one):</label>

              <div class="col-md-6">
                <select class="form-control" id="sensitivity" name="sensitivity" >
                  <option value="1">Low</option>
                  <option value="2">Medium</option>
                  <option value="3">High</option>

                </select>                               

                @if ($errors->has('sensitivity'))
                <span class="help-block">
                  <strong>{{ $errors->first('sensitivity') }}</strong>
                </span>
                @endif
              </div>
            </div>

           <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-basic btn-sm btn-block" > Save</button>

        <a class="btn btn-default btn-block"  href="{{ route('delivers.show', $deliver->idDeliver) }}">Cancel</a>
           
        </div>
   
     </div>
  
            </form>
         
      </div>
    </div>
  </div>
</div>
</div>
        
    @endsection
