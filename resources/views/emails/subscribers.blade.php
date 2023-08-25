@component('mail::message')
# Thanks you test with {{ config('app.name') }}

Dear {{$email}},

We look forward to communicating more with you. For more information visit our blog.

@component('mail::button', ['url' => 'enter your desired url'])
Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent