@component('mail::message')
# Verify your email

Hello {{ $user->name }},

Thank you for registering at Mithila Tech. Click the button below to verify your email. The link is valid for 60 minutes.

@component('mail::button', ['url' => $url])
Verify Email Address
@endcomponent

If you did not create an account, no further action is required.

Thanks,<br>
Mithila Tech Team
@endcomponent
