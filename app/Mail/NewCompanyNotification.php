<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewCompanyNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Company $company)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Company Created: ' . $this->company->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new_company',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
