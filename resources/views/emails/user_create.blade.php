<x-mail::message>

Dear {{ $user['name'] }},
<br> <br>
Thank you for completing your registration.
<br><br>
This email serves as a confirmation that your account is activated and that you are officially a part of the <span style="font-weight: bold;">{{ config('app.name') }}</span> family.
Enjoy!
<br><br><br>
Regards,
<br>
The {{ config('app.name') }} team

</x-mail::message>
