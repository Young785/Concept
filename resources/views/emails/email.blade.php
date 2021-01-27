@component('mail::message')
# Spree

Dear {{ $user['username'] }}<br>
Thank you for creating a Spree account. <br>

Please visit the link below and sign into your account to verify your email address and complete your registration: <br>
<a href="http://127.0.0.1:8000/main/verify/verificationId={{ session()->get("hash") }}">http://127.0.0.1:8000/main/verify?verificationId={{ session()->get("hash") }}</a>
<br>
If you have any question, please do not hesitate to reach out to us, by replying this email

Thanks,<br>
Spree.
@endcomponent
