<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;

        $this->event = $data['event'];
        $this->customer = $data['user'];
        $this->tickets = $data['tickets'];
        $this->pdf = $data['file'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->attachData($this->pdf, 'invoice.pdf', [
            'mime' => 'application/pdf'
        ])->markdown('emails.invoice');
    }
}
