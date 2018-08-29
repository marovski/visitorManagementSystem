@extends ('pages.dashboard')
@section('title','| Pie Charts')

@section('dashboard')
<form action="{{ route('barChart.show') }}"> <input type="month" name="month"  required=""> <input type="text" name="idchart" hidden="" value="2"> <button class="btn btn-default btn-sm" type="submit" >Make Graph</button></form><br>
<div class="well">
<div id="departments" style="width: 600px;height:400px;"></div>
   
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('departments'),'sakura');
    var option = {
     title: {
                text: 'Registed by the User'
            },
            toolbox: {
            show : true,
             feature : {
                mark : {show: true},
                restore : {show: true},
                saveAsImage : {show: true}
                     }
            },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient: 'horizontal',
        left: 'left',
        data: ['Deliveries','Drops']
    },
    series : [
        {
            name: 'Regists',
            type: 'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:@if(!empty($deliveries)){{ $deliveries->where('deIdUser', Auth::user()->idUser)->count() }}@else "No value"@endif, name:'Deliveries'},
                {value:@if(!empty($drops)){{ $drops->where('dropIdUser', Auth::user()->idUser)->count() }}@else"No value"@endif, name:'Drops'}
              
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
};

  // use configuration item and data specified to show chart
        myChart.setOption(option);
</script>
</div>
 @endsection