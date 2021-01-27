@component('mail::message')
<strong> Spree </strong> <br>

<b>Forgot Your Password?</b>

<img src="http://127.0.0.1:8000/assets/images/forgot.gif" alt="Forgot Password"> <br>

That’s okay. You can create your new password here. <br>
<a href="http://127.0.0.1:8000/main/forgot-password/reset-password={{ session()->get("hash") }}?email={{ $user['email'] }}">http://127.0.0.1:8000/main/forgot-password/reset-password={{ session()->get("hash") }}?email={{ $user['email'] }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
