<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\CourseReservation;
use App\Models\ConfigSite;

class ZoomUrlNotificationMail extends Mailable
{

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct( public CourseReservation $courseReservation,public  $site){
 
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Course Reservation Mail',
        );
    }

    public function build()
    {
    return $this->markdown('email.zoom_url_notification');
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.zoom_url_notification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
