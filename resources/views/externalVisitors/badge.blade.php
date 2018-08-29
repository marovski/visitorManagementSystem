
    @extends('main')

    @section('title', '| Badge Print')

    @section('assets')
    <link rel='stylesheet' href='/css/parsley.css' />
    @endsection

    @section('content')
    <?php
            use Carbon\Carbon;?>

<style type="text/css" media="print">
@media print {
  @page { margin: 0; }
  body { margin: 1.6cm; }
}
</style>

<script>
$(function() {
    $("footer").hide();
});
</script>

    <div id="print" class="container" ng-app="MyApp" style="width: 550px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="margin-left: 11.666667%;">
            <div class="panel panel-default" style="width: 400px; height: 250px;">
                <div class="panel-body" ng-controller="showInputController">
                <div class="form-group" style="">
                <div class="row">
                <div class="col-md-6" style="width: 400px">
                    <div id="logo">
                    <img src="/images/nanium.jpg">
                     <h5 style="">Expires at: {{ date('d-m-Y', strtotime($current = Carbon::now('Europe/Lisbon')))}}</h5>
                    </div>
                    <br>   
                    <div class="row"> 
                    <div class="col-xs-6">         
                    <h4 align="left">Visitor: {{ $externalVisitor->visitorName }}</h4>
                    @foreach ($externalVisitor->meeting as $meetingE)
                    <p align="left">
                    Topic: {{ $meetingE->meetingName }}<br>
                    Host: {{ $user->find($meetingE->meetIdHost)->username}}
                    </p>
                    </div>
                    <br>
                    <div class="col-xs-6 text-right" style="margin-top: -9px;">
                    {!! DNS2D::getBarcodeSVG(" $externalVisitor->idVisitor, $externalVisitor->visitorName, $externalVisitor->visitorCompanyName", 'QRCODE') !!}
                    </div>
                    <br>
                    <br>
                    @endforeach
                    </div>
                </div>
                </div>
                <header class="header b-b b-light hidden-print">
                <div class="col-md-12" style=" width: 113%; margin-left: -21px; margin-top: 35px;">
                <button type="submit" class="btn btn-basic btn-sm btn-block" onClick="window.print();">
                Print
                </button>
                <a href="{{ URL::previous() }}" class="btn btn-default btn-sm btn-block">Return</a>
                </div>
                </header>              
                </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    @endsection