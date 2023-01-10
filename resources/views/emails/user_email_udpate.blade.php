<x-mail::message>
Dear {{ $user['name'] }},
<br> <br>
Have a good day. 
<br>
@if($sent_type == 'old_mail')       
    We see that you changed your Hello Task account email at {{ $user->updated_at->format('F d,Y, H:m:i') }}.
    If you haven't changed it, contact the Hello Task Tech Center as soon as possible.    
@else 
    Your Hello Task account email has been successfully changed.
@endif
<br> <br> <br>
Thanks,
<br>
Hello Task
</x-mail::message>
