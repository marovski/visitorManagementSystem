    @extends('main')

    @section('title', '| Create New Lost and Found Report')

    @section('assets')
    <link rel='stylesheet' href='/css/parsley.css' />
    @endsection

@section('content')
<div class="container" ng-app="MyApp">
    <div class="row" >
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span> <b>Create Lost Item Report</b></div>
                <div class="panel-body" ng-controller="showInputController">
                                
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('losts.store') }}" enctype="multipart/form-data" >
                        {{ csrf_field() }}
      
                         <div class="form-group{{ $errors->has('finderName') ? ' has-error' : '' }}">
                            <label for="finderName" class="col-md-4 control-label"><span class="after">*</span> Finder Name:</label>

                            <div class="col-md-6">
                                <input id="finderName" type="text" class="form-control" name="finderName" value="{{ old('finderName') }}" required autofocus placeholder="Type here the finder's name" ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()">

                                @if ($errors->has('finderName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('finderName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('finderPhone') ? ' has-error' : '' }}">
                            <label for="finderPhone" class="col-md-4 control-label"><span class="after">*</span> Finder Phone:</label>

                            <div class="col-md-6">
                                <input id="finderPhone" type="text" class="form-control" name="finderPhone" value="{{ old('finderPhone') }}" placeholder="Type here the finder's phone"  autofocus ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()">

                                @if ($errors->has('finderPhone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('finderPhone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    <div class="form-group{{ $errors->has('itemCategory') ? ' has-error' : '' }}">
                            <label for="itemCategory" class="col-md-4 control-label"><span class="after">*</span> Category:</label>

                            <div class="col-md-6">

                                <select class="form-control" name="itemCategory" ng-model="itemCategory" required >
                                    <option value="1" checked>Document</option>
                                      <option value="2">Electronic</option> 
                                      <option value="3"> Money</option> 
                                      <option value="4"> Gadget</option>
                                      <option value="5"> Cloth</option>
                                      <option value="6"> Other</option>


                                   

                                </select>                                

                                @if ($errors->has('itemCategory'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('itemCategory') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div  ng-show="itemCategory != 0" class="form-group{{ $errors->has('lostFoundDescription') ? ' has-error' : '' }}"  >
                            <label for="lostFoundDescription" class="col-md-4 control-label"> Description:</label>

                            <div class="col-md-6">
                                <textarea rows="4" cols="" class="form-control" name="lostFoundDescription" placeholder="Type here a description about the item" ng-copy="$event.preventDefault()" ng-paste="$event.preventDefault()"></textarea>                                

                                @if ($errors->has('lostFoundDescription'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lostFoundDescription') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    
                        <div class="form-group{{ $errors->has('lostFoundItemSize') ? ' has-error' : '' }}">
                            <label for="lostFoundItemSize" class="col-md-4 control-label">Item Size:</label>

                            <div class="col-md-6">                                
                                <label class="radio-inline"><input type="radio" name="lostFoundItemSize" value="Small" checked>Small size</label>
                                <label class="radio-inline"><input type="radio" name="lostFoundItemSize" value="Medium">Medium size</label>
                                <label class="radio-inline"><input type="radio" name="lostFoundItemSize" value="Large">Large size</label>

                                @if ($errors->has('LostFoundItemSize'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('LostFoundItemSize') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lostFoundImportance') ? ' has-error' : '' }}">
                            <label for="lostFoundImportance" class="col-md-4 control-label">Importance:</label>

                            <div class="col-md-6" >
                            <p>
                                <select class="form-control" name="lostFoundImportance">
                                  <option value="1">Low</option>
                                  <option value="2">Medium</option> 
                                  <option value="3">High</option>
                                </select>

                                @if ($errors->has('lostFoundImportance'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lostFoundImportance') }}</strong>
                                    </span>
                                @endif
                            </p>
                        </div>
                        </div>

                        <div class="form-group">
                        <label for="image" class="col-md-4 control-label" >Photo Upload:</label>
                        <div class="col-md-6">
                        <input type="file" name="image"  id="image" class="form-control"/>
                        </div>
                        </div>
          
                                                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-basic btn-sm btn-block">
                                  Save Report
                                </button>
                                <a href="{{ route('losts.index') }}" class="btn btn-default btn-block">Cancel</a>
                            </div>
                           
                        </div>               
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection