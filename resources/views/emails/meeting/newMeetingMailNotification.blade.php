@component('mail::message')

# Welcome to Nanium @if(!empty( $mailInfo2->visitorName ))
{{ $mailInfo2->visitorName }}
@else
{{ $mailInfo2->username }}
@endif



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
@if(!empty( $mailInfo2->visitorName ))
Address:
<div align="center">
 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2996.3771300848243!2d-8.71967868501539!3d41.322411979270136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2443baf0d52a21%3A0x367757af80c44031!2sNANIUM%2C+S.A!5e0!3m2!1spt-PT!2spt!4v1499634561533" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
@endif
<br>
Thank you,<br>
{{ config('app.name') }}
@endcomponent