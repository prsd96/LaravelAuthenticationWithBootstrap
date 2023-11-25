<x-mail::message>
# Introduction

Click the button below to verify your email.

<x-mail::button :url="$verificationURL">
Verify Your Email
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
