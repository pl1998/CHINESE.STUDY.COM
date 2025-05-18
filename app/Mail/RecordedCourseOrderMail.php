<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\CoursePracticeOrder;

class RecordedCourseOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public CoursePracticeOrder $order,public array $config,public bool $merchant = false)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Recorded Course Order Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if (!$this->merchant) {
            return new Content(
                markdown: 'email.recorded_course_order',
            );
        } else {
            return new Content(
                markdown: 'email.merchant.recorded_course_order',
            );
        }
    }
    public function build()
    {
       if(!$this->merchant) {
           return $this->markdown('email.recorded_course_order');
       } else{
           return $this->markdown('email.merchant.recorded_course_order');
       }
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
