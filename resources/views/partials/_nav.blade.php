
<!-- Default Bootstrap Navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="">Guests and Visitors</a>
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="{{ Request::is('/') ? "active" : "" }}"><a href="/"><span class="glyphicon glyphicon-home"></span> Home</a></li>


        <li class="{{ Request::is('about') ? "active" : "" }}"><a href="/about"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
        <!--<li class="{{ Request::is('contact') ? "active" : "" }}"><a href="/contact"><span class="glyphicon glyphicon-envelope"></span> Contact</a></li>-->
      </ul>
      <ul class="nav navbar-nav navbar-right">

      @if (Auth::check())

        <div class="dropdown">
          <button href="/" class="dropbtn" style="position:relative; padding-left:50px;"><img src="/images/{{ Auth::user()->photo }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">     {{ Auth::user()->username }} <span class="caret"></span></button>
         
          <div class="dropdown-content">

            @if (Auth::check() && Auth::user()->role()==true)
              
              @include('partials._navReception')
            
            @endif
            @if(Auth::check() && Auth::user()->role()==false)
              
              
              @include('partials._navStaff')

            @endif
            </div>
            </div>
            <li role="separator" class="divider"></li>
            <li><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="glyphicon glyphicon-log-out"></span> Logout</a>

              <form id="logout-form" action="{{ route('logout') }}" method="get" style="display: none;">{{ csrf_field() }}</form></li>
            </ul>
          </li>



          @else
        

<li>  <a href="{{ route('visitors.selfcheckIn') }}">   <span class="glyphicon glyphicon-check"></span> Self SignIn</a></li>

          @endif

        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>