<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color:#111;">
    <div style="max-width:640px;margin:0 auto;border:1px solid #eee;border-radius:8px;overflow:hidden">
        <div style="background:#6d28d9;color:#fff;padding:16px 20px;">
            <h2 style="margin:0;font-size:18px;">SafeSpace — New Report Submitted</h2>
        </div>
        <div style="padding:20px;">
            <p style="margin:0 0 10px;">A new report has been submitted.</p>
            <p style="margin:0 0 4px;"><strong>Reference:</strong> {{ $report->reference }}</p>
            <p style="margin:0 0 4px;"><strong>Category:</strong> {{ ucfirst(str_replace('_',' ', $report->category)) }}</p>
            <p style="margin:0 0 4px;"><strong>Location:</strong> {{ $report->location ?? '—' }}</p>
            <p style="margin:12px 0;"><strong>Description:</strong><br>{{ nl2br(e($report->description)) }}</p>

            <p style="margin:18px 0 6px;">Open the report:</p>
            <p>
                <a href="{{ $viewUrl }}" style="display:inline-block;background:#8b5cf6;color:#fff;text-decoration:none;padding:10px 14px;border-radius:6px;">
                    View Report
                </a>
            </p>

            <p style="margin-top:24px;color:#666;font-size:12px;">You’re receiving this because you are an admin on SafeSpace.</p>
        </div>
    </div>
</body>
</html>
