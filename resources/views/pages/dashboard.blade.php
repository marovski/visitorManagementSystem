
@extends('main')
@section('title','| Charts and Exports')
@section('assets')

  <!-- load echarts package -->


 <script src="/js/echarts-all-english-v2.js"></script>

@endsection
    @section('content')

    
<div class="container-fluid" ng-app="MyApp">

  <div class="row content">
            <div class="col-sm-3 navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        
                        <li {{ (Request::is('*dashboard.charts') ? 'class="active"' : '') }}> 
                            <a style="color: #310826;"  href="{{ route('dashboard.charts') }}"><i class="fa fa-bar-chart-o fa-fw"></i> Charts</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li {{ (Request::is('*dashboard.tables') ? 'class="active"' : '') }}>
                            <a style="color: #310826;" href="{{ route('dashboard.tables') }}"><i class="fa fa-table fa-fw"></i> Tables</a>
                        </li>
                      
                      
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>


   
    
    <div class="col-sm-9">

                 
       
      <div class="row">
        <div class="col-sm-3" style="width: 80%;" >
@if (\Request::is('dashboard'))  
 <img src="/images/report.png" style="width: 93%;
    margin-top: -46px;">
@endif

     <div>
     
    
   
     @yield('dashboard')

     </div>   

        </div>
 
  </div>
</div>

{{-- option = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c}%"
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    series : [
        {
            name:'业务指标',
            type:'gauge',
            detail : {formatter:'{value}%'},
            data:[{value: 50, name: '完成率'}]
        }
    ]
};

clearInterval(timeTicket);
timeTicket = setInterval(function (){
    option.series[0].data[0].value = (Math.random()*100).toFixed(2) - 0;
    myChart.setOption(option, true);
},2000); --}}

{{-- <table class="bar-chart">
<tr ng-repeat="jog in data | limitTo:-10">
<td> {{jog.date | date}} </td>
<td> {{jog.time | number}} Minutes </td>
<td> {{jog.distance | number}} Miles </td>
</tr>
</table> --}}

@endsection