 @extends('main')

    @section('title', '| View Drop')

    @section('assets')
    <link rel='stylesheet' href='/css/parsley.css' />
    @endsection

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Drop View</div>
                <div class="panel-body">
                 <form class="form-horizontal">
                                     
                        <div class="form-group{{ $errors->has('dropperCompany') ? ' has-error' : '' }}">
                            <label for="dropperCompany" class="col-md-4 control-label">Company Name:</label>
                            <div class="col-md-6">
                            <input id="dropperCompany" type="text" class="form-control" name="dropperCompany" disabled="true" value="{{ $drop->dropperCompanyName}}">

                                @if ($errors->has('dropperCompany'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dropperCompany') }}</strong>
                                    </span>
                                @endif
                             </div>
                        </div>

                        <div class="form-group{{ $errors->has('dropperName') ? ' has-error' : '' }}">
                            <label for="dropperName" class="col-md-4 control-label">Dropper Name:</label>

                            <div class="col-md-6">
                                <input id="dropperName" type="text" class="form-control" name="dropperName" disabled="true" value="{{ $drop->dropperName }}">

                                @if ($errors->has('dropperName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dropperName') }}</strong>
                                    </span>
                                @endif
                              </div>
                        </div>

                        <div class="form-group{{ $errors->has('dropperName') ? ' has-error' : '' }}">
                            <label for="ReceiverName" class="col-md-4 control-label">Receiver Name:</label>

                            <div class="col-md-6">
                                <input id="ReceiverName" type="text" class="form-control" name="ReceiverName" disabled="true" value="{{ $drop->dropReceiver }}" required autofocus>

                                @if ($errors->has('ReceiverName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ReceiverName') }}</strong>
                                    </span>
                                @endif
                              </div>
                        </div>


                        <div class="form-group{{ $errors->has('dropSize') ? ' has-error' : '' }}">
                            <label for="dropSize" class="col-md-4 control-label">Item Size:</label>
                             <div class="col-md-6">
                                <label class="radio-inline"><input type="radio" name="dropSize" disabled="true"  checked="checked" value="">
                                @if ($drop->dropSize=="Large")
                                Large 
                                @elseif($drop->dropSize=="Medium")
                                Medium
                                @elseif($drop->dropSize=="Small") 
                                Small
                                @else
                                No information available
                                @endif
                                </label>
                                

                                @if ($errors->has('dropSize'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dropSize') }}</strong>
                                    </span>
                                @endif
                             </div>
                        </div>

                        <div class="form-group{{ $errors->has('dropImportance') ? ' has-error' : '' }}">
                            <label for="dropImportance" class="col-md-4 control-label">Importance:</label>

                            <div class="col-md-6" >
                            <p>
                                <select class="form-control" name="dropImportance" disabled="true">
                                 @if ($drop->dropImportance==3)
                                  <option value="">High</option>
                                  @elseif ($drop->dropImportance==2)
                                  <option value="">Medium</option>
                                  @else
                                  <option value="">Small</option>
                                  @endif   
                                </select>

                                @if ($errors->has('dropImportance'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dropImportance') }}</strong>
                                    </span>
                                @endif
                            </p>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dropDescription') ? ' has-error' : '' }}">
                            <label for="dropDescription" class="col-md-4 control-label"> Description:</label>

                            <div class="col-md-6">
                                <textarea rows="4" cols="" class="form-control" disabled="true" name="dropDescription">{{ $drop->dropDescr }}</textarea>                               

                                @if ($errors->has('dropDescription'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dropDescription') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                                                        
                      
                    </form>   
                </div>
            </div>
        </div>
    
    <div class="col-md-4" >
      <div class="well">
     

        <dl class="dl-horizontal">
          <label>Dropped at:</label>
          <p>{{ date('M j, Y h:ia', strtotime($drop->droppedWhen)) }}</p>
        </dl>

        <dl class="dl-horizontal">  
          <label>Received Date:</label>
          <p>{{ $drop->dropReceivedDate ? date('M j, Y h:ia', strtotime($drop->dropReceivedDate)) : '' }}</p>
        </dl>
        <hr>
        <div class="row">
       
         
          <div class="col-sm-12">         
        {{ Form::open(['class'=>'form-group','route' => ['drops.destroy', $drop->idDrop], 'method' => 'delete']) }}
          <div class="form-group">
                   
                        <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you want to delete this?')">
                           Delete
                       </button>


                
               </div> 
           {{ Form::close() }}

          </div>
      

            <div class="col-md-12">
          <a href="{{ route('drops.index') }}" class="btn btn-default btn-block btn-h1-spacing"> << See All Drops</a>             
          </div>
        </div>
      </div>  
  </div>
    </div>


@endsection