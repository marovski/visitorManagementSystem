  
@extends ('pages.dashboard')
@section('title','| Tables')

@section('dashboard')

    
    <ul class="square-menu">
     <li>
       <a href="{{ route('dashboard.delivers') }}" class="slink-xf">Delivers</a>
     </li>
     <li>
       <a href="{{ route('dashboard.drops') }}" class="slink-xs">Drops</a>
     </li>
     <li>
       <a href="{{ route('dashboard.lostItems') }}" class="slink-xt">Lost Items</a>
     </li>
     <li>
       <a href="{{ route('dashboard.meetings') }}" class="slink-xfour">Meetings</a>
     </li>
    <br style="clear:both;"/>
    </ul>
  

    @endsection