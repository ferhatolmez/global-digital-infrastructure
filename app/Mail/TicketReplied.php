<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class TicketReplied extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.tickets.replied', // E-posta tasarımı burası olacak
            with: ['subject' => $this->ticket->subject]
        );
    }
}
