<!-- resources/views/emails/application_notification.blade.php -->
<p>New application received for {{ $career->title }}.</p>
<p><strong>Applicant Details:</strong></p>
<ul>
    <li><strong>Name:</strong> {{ $application->name }}</li>
    <li><strong>Email:</strong> {{ $application->email }}</li>
    @if($application->phone)
        <li><strong>Phone:</strong> {{ $application->phone }}</li>
    @endif
    @if($application->cover_letter)
        <li><strong>Cover Letter:</strong> {{ $application->cover_letter }}</li>
    @endif
    <li><strong>Resume:</strong> <a href="{{ Storage::url($application->resume_path) }}">Download Resume</a></li>
</ul>
<p>Please review the application in the admin dashboard.</p>
<p>Best regards,<br>Mithila Tech System</p>