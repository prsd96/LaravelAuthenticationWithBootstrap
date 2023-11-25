<x-mail::message>
# Introduction

Click the button below to reset your password.

<x-mail::button :url="$resetURL">
Reset Your Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
