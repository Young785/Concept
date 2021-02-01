@component('mail::message')
<b> Spree </b>

Dear {{ $user['username'] }}<br>
Thank you for Spree vendor's application. <br>

<img src="http://127.0.0.1:8000/assets/images/vendor.jpg" alt="Vendor request accepted" style="width: 500px"> <br>

We are proud to announce to you that you are now a vendor at Spree's Company: <br>
Click the link below to login to your vendor's Portal. Use your email and Password to login. Thanks <br>
<a href="http://127.0.0.1:8000/pages/login/verify/verificationId={{ session()->get("hash") }}">http://127.0.0.1:8000/pages/login/verify/verificationId={{ session()->get("hash") }}</a>
<br>
If you have any question, please do not hesitate to reach out to us, by replying this email

Thanks,<br>
Spree.
@endcomponent