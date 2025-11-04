@component('mail::message')
# Mithila Tech Password Reset OTP

Hello,

You have requested to reset your password. Please use the following One-Time Password (OTP) to proceed:

**OTP: {{ $otp }}**

This OTP is valid for 10 minutes. If you did not request a password reset, please ignore this email.

Thank you,  
Mithila Tech Team

@component('mail::button', ['url' => url('/password/reset-otp?email=' . urlencode($email))])
Reset Password
@endcomponent
@endcomponent
