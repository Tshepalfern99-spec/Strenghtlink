<?php

namespace App\Mail;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportAcknowledgementMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Report $report) {}

    public function build()
    {
        return $this->subject('We received your report')
            ->view('emails.report_acknowledgement');
    }
}
