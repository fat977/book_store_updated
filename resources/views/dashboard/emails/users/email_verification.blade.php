<x-mail::message>
Welcome : {{ $user->name }}.
This link to verify your email address
<x-mail::button :url="$url">
Verify Email
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
