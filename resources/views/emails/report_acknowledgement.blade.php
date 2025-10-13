<!DOCTYPE html>
<html>
<body style="font-family:system-ui,Arial,sans-serif">
  <p>Hi,</p>
  <p>Thank you for reporting your incident to Strengthlink. Your reference is <strong>#{{ $report->id }}</strong>.</p>
  <p>Our team has received your report (category: <strong>{{ ucfirst($report->category) }}</strong>) and is reviewing it. If you need immediate assistance, please use the emergency resources below.</p>
  <p>
    • Browse support resources: <a href="{{ route('resources.index') }}">Strengthlink Resources</a><br>
    @if($report->location_text)
      • Location you provided: {{ $report->location_text }}
    @endif
  </p>
  <p>Take care,<br>Strengthlink Team</p>
</body>
</html>
