<x-mail::message>


<p>hello {{ $admin->name}}</p>
<p>You are receiving this email because we received a password reset request for your account.</p>
<p> This is your code : {{ $admin->code}} </p>
<x-mail::button :url="''">
Reset Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
