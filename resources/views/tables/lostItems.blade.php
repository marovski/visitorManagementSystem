  
@extends ('pages.dashboard')
@section('title','| Tables')

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
                            <th width="">Finder Name</th>
                            <th width="">Finder Phone</th>
                            <th width="">Item Description</th>
                            <th width="">Receiver Name</th>
                            <th width="">Claimed at</th>
                        </tr>
                    </thead>

               <tbody>
                        @foreach($losts as $lost )
                            <tr>
                                <td>{{ $lost->finderName }}</td>
                                <td>{{ $lost->finderPhone }}</td>
                                <td>{{ $lost->itemDescription }}</td>
                                <td>{{ $lost->receiverName }}</td>
                                <td>{{ $lost->claimedDate ? date('M j, Y H:i', strtotime($lost->claimedDate)) : '' }}</td>
                                <td>
                            </tr>   
                        @endforeach
                </tbody>
            </table>    
             <a href="{{ URL::previous() }}" class="btn btn-default btn-sm btn-block">Return</a>
        </div>
      </div>
 
    @endsection