@extends('main')

@section('title', '| All Drops')

@section('content')

	<div class="row">
		<div class="col-md-10">
			<h1>All Drops</h1>
		</div>

	<div class="col-md-2">
			<a href="{{ route('drops.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing"><span class="glyphicon glyphicon-plus"></span> New Drop</a>
		</div>
		<div class="col-md-12">
			<hr>
		</div>
	</div> <!-- end of .row -->
    <form action="/search/drops" method="get" role="form">
<div class="input-group custom-search-form col-xs-4">

                                <input type="text" name="q" class="form-control" placeholder="Search..." value="{{ Request::get('q') }}">    <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                              
                          
                      
                            </div>
      </form>
<section class="panel panel-default" ng-app="MyApp"  ng-controller="showInputController">
<i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>

     <div class="table-responsive" >

                <table class="table table-striped m-b-none" data-ride="datatables" id="table">
                    <thead>
                        <tr>
                            <th width="">Company Name</th>
                            <th width="">Dropper Name</th> 
                            <th width="">Receiver Name</th>
                            <th width="">Drop Item</th>
                            <th width="">Dropped at</th>
                            <th width="">Received at</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($drops as $drop )
                            <tr>
                                <td title="{{ $drop->dropperCompanyName }}">{{ $drop->dropperCompanyName }}</td>
                                <td title="{{ $drop->dropperName }}">{{ $drop->dropperName }}</td>
                                <td title="{{ $drop->dropReceiver }}">{{ $drop->dropReceiver }}</td>
                                <td title="{{ $drop->dropDescr }}">{{ $drop->dropDescr }}</td>
                                <td title="{{ date('M j, Y H:i', strtotime($drop->droppedWhen)) }}">{{ $drop->droppedWhen ? date('M j, Y H:i', strtotime($drop->droppedWhen)) : '' }}</td>
                                <td title="{{ date('M j, Y H:i', strtotime($drop->dropReceivedDate)) }}">{{ $drop->dropReceivedDate ? date('M j, Y H:i', strtotime($drop->dropReceivedDate)) : '' }}</td>
                                <td>
                              
                                <a href="{{ route('drops.show',$drop->idDrop) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> View</a>
                                        </td>
                                        <td>
                                  @if (empty($drop->dropReceivedDate))
                                <a href="{{ route('drops.checkOut',$drop->idDrop) }}" class="btn btn-default btn-sm"><i class="fa fa-mail-forward" ></i> Check-out</a>
                                @else <a disabled="disabled" class="btn btn-default btn-sm"><i class="fa fa-mail-forward" ></i> Check-out</a>
                                @endif
                                </td>
                               
							    
						</tr>

					@endforeach

				</tbody>
			</table>

			<div class="text-center">
				{!! $drops->links(); !!}
			</div>
		</div>
	</section>
	
@stop