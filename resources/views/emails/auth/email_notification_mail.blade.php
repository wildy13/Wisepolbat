@component('mail::message')
# Hello !
<br>

<p>
    {!! $pesan !!}
</p>

<br>Thanks,<br>
{{ config('app.name') }}
@endcomponent