  
@extends ('pages.dashboard')
@section('title','| Tables')

@section('dashboard')
   <header class="panel-heading">
            
                <button onClick ="$('#table').tableExport({type:'pdf',escape:'false',pdfFontSize:12,separator: ','});" class="btn btn-default btn-xs pull-right">PDF</i></button>
                <button onClick ="$('#table').tableExport({type:'csv',escape:'false'});" class="btn btn-default btn-xs pull-right">CSV</button>
                <button onClick ="$('#table').tableExport({type:'excel',escape:'false'});" class="btn btn-default btn-xs pull-right">Excel</i></button>
                
            
   </header>

     <div class="table-responsive">

                <table class="table table-striped m-b-none" data-ride="datatables" id="table" style="width: 113%;
    ">
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
                                <td>{{ $drop->dropperCompanyName }}</td>
                                <td>{{ $drop->dropperName }}</td>
                                <td>{{ $drop->dropReceiver }}</td>
                                <td>{{ $drop->dropDescr }}</td>
                                <td>{{ date('M j, Y H:i', strtotime($drop->droppedWhen)) }}</td>
                                <td>{{ $drop->dropReceivedDate ? date('M j, Y H:i', strtotime($drop->dropReceivedDate)) : '' }}</td>
                                <td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
            <a href="{{ URL::previous() }}" class="btn btn-default btn-sm btn-block">Return</a>
       
        </div>
      </div>

    @endsection