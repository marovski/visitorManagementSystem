<li><a href="{{ route('meetings.index') }}"><i class="fa fa-group"></i> Meetings</a></li>
<li><a href="{{ route('dashboard') }}"><span class="glyphicon glyphicon-stats"></span> Charts/Exports</a></li>
@if(Auth::user()->isOrgAdmin())
<li class="{{ Request::is('admin*') ? "active" : "" }}"><a href="{{ route('admin.index') }}"><span class="glyphicon glyphicon-cog"></span> Admin Panel</a></li>
@endif


