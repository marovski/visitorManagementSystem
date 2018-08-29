<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Meeting;

class NewMeetingNotification extends Mailable
{
    use Queueable, SerializesModels;
    
    public $mailInfo;
    public $mailInfo2;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($meeting, $visitor)
    {
        $this->mailInfo=$meeting;   
        $this->mailInfo2=$visitor;   
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.meeting.newMeetingMailNotification');
                    
    }
}
