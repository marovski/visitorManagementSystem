  
@extends ('pages.dashboard')
@section('title','| Bar Charts')

@section('dashboard')

<form action="{{ route('barChart.show') }}"> <div class="col-xs-4"><input type="month" name="month" class="form-control input-sm" required=""> <input type="text" name="idchart"  hidden="" value="1"> </div><button class="btn btn-default btn-sm" type="submit" >Make Graph</button></form><br>

 <div class="well"  >
     
        <!-- prepare a DOM container with width and height -->
    <div id="main" style="width: 600px;height:400px;"></div>

    <script type="text/javascript">
        // based on prepared DOM, initialize echarts instance
        var myChart = echarts.init(document.getElementById('main'),'sakura');

        // specify chart configuration item and data
        var option = {

            title: {
                text: @if (!empty($input))'{{ date('F', strtotime("$input")) }}' @else 'Insert the month' @endif + ' Regists'
            },
            toolbox: {
            show : true,
             feature : {
                mark : {show: true},
                restore : {show: true},
                saveAsImage : {show: true}
                     }
            },
            
            tooltip: { trigger: 'axis'},
            legend: {
                data:['Number of Regists']
            },
            xAxis: {
                data: ["Deliveries","Drops","LostF Items","Meetings","Visitors"]
            },
            yAxis: {},
            series: [{
                name: 'regists',
               
                type: 'bar',
                data: [@if (!empty($deliveries)) {{ $deliveries->count() }}@else "Empty Month" @endif,@if (!empty($drops)) {{  $drops->count() }}@else "Empty Month" @endif,@if (!empty($lostItems)) {{ $lostItems->count() }} @else "Empty Month" @endif, @if (!empty($meetings)) {{ $meetings->count() }}@else "Empty Month" @endif,@if (!empty($meetings)) {{ $visitors->count() }}@else "Empty Month" @endif]
            }]
        };

        // use configuration item and data specified to show chart
        myChart.setOption(option);
    </script>
      </div>

{{--                 <div class="well" >
     <h3>Deliveries and Drops registed by the User</h3>
<canvas id="myChart" width="400" height="400"></canvas>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
  
  type: 'pie',
  data: {
    labels: ['Deliveries', 'Drops'],
    datasets: [{
      label: 'Regists by user',
      data: [@if(!empty($deliveries)){{ $deliveries->where('deIdUser', Auth::user()->idUser)->count() }}@else "No value"@endif,@if(!empty($drops)){{ $drops->where('dropIdUser', Auth::user()->idUser)->count() }}@else"No value"@endif],
      backgroundColor: [
        "#2ecc71",
        "#3498db"
      ],
    }]
  }
});
</script> --}}
 </div>

     



 
    @endsection