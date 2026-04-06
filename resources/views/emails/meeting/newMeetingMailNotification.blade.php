@component('mail::message')

# Bem-vindo(a)@if(!empty( $mailInfo2->visitorName )), {{ $mailInfo2->visitorName }}@else, {{ $mailInfo2->username }}@endif



You have a meeting scheduled for {{ date('M j, Y', strtotime($mailInfo->meetStartDate)) }}, at {{ date('H:i', strtotime($mailInfo->meetStartDate)) }}.

<b>Meeting:</b> {{$mailInfo->meetingName}} 

<b>Room:</b> {{$mailInfo->room}}<br>

<b>Topic:</b> {{$mailInfo->visitReason}}
 
 @if(!empty( $mailInfo2->visitorName ))
Your meeting bar code:<br>

@component('mail::panel')
  <div align="center">
{!! DNS2D::getBarcodeSVG("* $mailInfo->idMeeting,$mailInfo2->idVisitor *", 'QRCODE') !!}
 </div> 
@endcomponent
@endif
@if(empty($mailInfo2->visitorCitizenCard) && empty($mailInfo2->idUser))
For this meeting is <b>compulsory</b> present your identification . Please bring your ID.
@endif<br>
<br>
<br>
Thank you,<br>
{{ config('app.name') }}
@endcomponent