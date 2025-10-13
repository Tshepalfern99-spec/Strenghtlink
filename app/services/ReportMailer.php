<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;
use App\Models\Report;
use Illuminate\Support\Facades\URL;

class ReportMailer
{
    public static function notifyAdmin(Report $report): void
    {
        $adminEmail = config('mail.admin_alert_email', env('ADMIN_ALERT_EMAIL'));
        if (!$adminEmail) return;

        $viewUrl = route('admin.reports.show', $report); // protected by admin middleware
        $subject = "New Report {$report->reference} — " . ucfirst(str_replace('_',' ', $report->category));

        $html = view('emails.new-report-admin', [
            'report' => $report,
            'viewUrl' => $viewUrl,
        ])->render();

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = env('sandbox.smtp.mailtrap.io');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('6e46fbb9528442');
            $mail->Password   = env('=9a7859700d892c');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls') ?: PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = (int) env('MAIL_PORT', 587);

            $mail->setFrom(env('MAIL_FROM_ADDRESS','no-reply@strengthlink.com'), env('MAIL_FROM_NAME', 'Strenghtlink'));
            $mail->addAddress($adminEmail);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $html;

            $mail->send();
        } catch (MailException $e) {
            // Swallow to avoid breaking user flow; log for diagnostics
            logger()->warning('ReportMailer failed: '.$e->getMessage());
        }
    }
}
