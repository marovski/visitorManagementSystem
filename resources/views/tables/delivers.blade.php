  
@extends ('pages.dashboard')
@section('title','| Delivers')

@section('dashboard')
   <header class="panel-heading">
            
                <button onClick ="$('#table').tableExport({type:'pdf',escape:'false',pdfFontSize:12,separator: ','});" class="btn btn-default btn-xs pull-right">PDF</i></button>
                <button onClick ="$('#table').tableExport({type:'csv',escape:'false'});" class="btn btn-default btn-xs pull-right">CSV</button>
                <button onClick ="$('#table').tableExport({type:'excel',escape:'false'});" class="btn btn-default btn-xs pull-right">Excel</i></button>
                
            
   </header>
     <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
     <div class="table-responsive">

                <table class="table table-striped m-b-none" data-ride="datatables" id="table" style="    width: 113%;
    ">
                    <thead>
                        <tr>
                            <th>Firm</th>
                            <th>Vehicle</th>
                            <th>Driver</th>
                            <th>Delivered At</th>
                            <th>Finished At</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($delivers as $deliver)
                        
                        <tr>
                            <th>{{ $deliver->id }}</th>
                                <td>{{ $deliver->deFirmSupplier}}</td>
                                    <td>{{ $deliver->vehicleRegistry}}</td>
                                        <td>{{ $deliver->deDriverName}}</td>
                            <td>{{ date('M j, Y', strtotime($deliver->deEntryTime)) }}</td>
                            <td>{{ $deliver->deExitTime ? date('M j, Y', strtotime($deliver->deExitTime)) : '' }}</td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

       <a href="{{ URL::previous() }}" class="btn btn-default btn-sm btn-block">Return</a>
        </div>
      </div>

    @endsection