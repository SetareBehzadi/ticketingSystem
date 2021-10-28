@component('mail::message')
# Verify Your Email

Dear {{$name}}

@component('mail::button', ['url' => $link])
veryfy your email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
