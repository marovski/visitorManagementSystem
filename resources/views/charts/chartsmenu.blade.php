@extends ('pages.dashboard')
@section('title','| Charts')

@section('dashboard')


   <ul class="square-menu">
     <li>
       <a href="{{ route('dashboard.barcharts') }}" class="slink-xf">Bar Charts</a>
     </li>
     <li>
       <a href="{{ route('dashboard.piecharts') }}" class="slink-xs">Pie Charts</a>
     </li>
   
    <br style="clear:both;"/>
    </ul>

@endsection