<x-mail::message>
Dear {{ $user['name'] }},
<br> <br>
Have a good day. 
<br>     
We see that you changed your Hello Task account password at {{ $user->updated_at->format('F d,Y, H:m:i') }}.
If you haven't changed it, contact the Hello Task Tech Center as soon as possible.    

<br> <br> <br>
Thanks,
<br>
Hello Task
</x-mail::message>
