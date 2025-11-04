<h1>New Contact Form Submission</h1>
<p><strong>Name:</strong> {{ $data['name'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Subject:</strong> {{ $data['subject'] }}</p>
<p><strong>Message:</strong> {{ $data['message'] }}</p>
<p><strong>Consent:</strong> {{ $data['consent'] ? 'Yes' : 'No' }}</p>
