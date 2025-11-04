<!-- resources/views/emails/application_confirmation.blade.php -->
<p>Dear {{ $application->name }},</p>
<p>Thank you for applying for the {{ $career->title }} position at Mithila Tech!</p>
<p>We have received your application and will review it soon. You will hear from our HR team within 5-7 business days.</p>
<p><strong>Application Details:</strong></p>
<ul>
    <li><strong>Position:</strong> {{ $career->title }}</li>
    <li><strong>Email:</strong> {{ $application->email }}</li>
    @if($application->phone)
        <li><strong>Phone:</strong> {{ $application->phone }}</li>
    @endif
</ul>
<p>If you have any questions, contact us at <a href="mailto:hr@mithilatech.com">hr@mithilatech.com</a>.</p>
<p>Best regards,<br>Mithila Tech HR Team</p>