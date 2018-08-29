  
@extends ('pages.dashboard')
@section('title','| Tables')

@section('dashboard')
   <header class="panel-heading">
            
                <button onClick ="$('#table').tableExport({type:'pdf',escape:'false',pdfFontSize:12,separator: ','});" class="btn btn-default btn-xs pull-right">PDF</i></button>
                <button onClick ="$('#table').tableExport({type:'csv',escape:'false'});" class="btn btn-default btn-xs pull-right">CSV</button>
                <button onClick ="$('#table').tableExport({type:'excel',escape:'false'});" class="btn btn-default btn-xs pull-right">Excel</i></button>
                
            
   </header>
    <table class="table table-striped m-b-none" data-ride="datatables" id="table" style="    width: 113%;
    ">
                    <thead>
                        <tr>  
                         <th width="">Meeting Name</th>
                            <th width="">Visit Reason</th>
            
                           
                            <th width="">Status</th>
                            <th width="">Host</th>

                            <th width="">Start </th>
                              
                               <th width="">Ended </th>
                              <th width="">Visitor arrival</th>
                                <th width="">Visitor departure</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach($meetings as $meeting )
 
                            <tr>
                            
                             <th>{{ $meeting->meetingName }}</th>

                                <td>{{ $meeting->visitReason }}</td>
                          
                                <td> @if ($meeting->meetStatus === 1) 
                                      {{ 'Scheduled' }}
                                    @elseif ($meeting->meetStatus === 2) 
                                        {{ 'Started' }}
                                    
                                    @elseif ($meeting->meetStatus === 3) 
                                        {{ 'Canceled' }}
                                    
                                     @elseif ($meeting->meetStatus === 4) 
                                        {{ 'Finished' }}
                                     @endif</td>
                                 
                                <td>{{$user->find($meeting->meetIdHost)->username}}</td>
                         
                                <td>{{ date('M j, Y H:i', strtotime($meeting->meetStartDate)) }}</td>
                                 <td>{{ date('M j, Y H:i', strtotime($meeting->meetEndDate)) }}</td>
                                   <td>{{ ($meeting->entryTime ? date('h:i:s A', strtotime($meeting->entryTime)) : '')  }}</td>
                                     <td>{{ ($meeting->exitTime ? date(' h:i:s A', strtotime($meeting->exitTime)) : '')  }}</td>
                                    <td>
                                
                        </tr>
               
                    @endforeach

                </tbody>
            </table>
            <a href="{{ URL::previous() }}" class="btn btn-default btn-sm btn-block">Return</a>  
        </div>
      </div>
 
    @endsection