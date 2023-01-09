<x-mail::message>
    Hi {{ $user['name'] }},
    <br> <br>
    It was great chatting with you earlier. I'm just getting in touch to check whether you had a chance to review the email I sent to you previously and whether you could reply?
    <br><br>
    If I don't hear from you in the next few days, I'll give you a call.
    <br><br><br>
    Best regards,
    <br>
    {{ config('app.name') }}
</x-mail::message>
