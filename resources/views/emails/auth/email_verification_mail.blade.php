@component('mail::message')
# Hello !
<p>Selamat anda telah berhasil melakukan registrasi, silahkan klik tombol Verifikasi Akun di bawah ini agar akun anda dapat diaktifkan</p>

@component('mail::button', ['url' => route('verify_email', $user->email_verification_code)])
Verifikasi Akun
@endcomponent

<p>Atau anda dapat menyalin link berikut ke browser anda :</p>
<a href="{{ route('verify_email', $user->email_verification_code) }}">{{ route('verify_email', $user->email_verification_code) }}</a>

<br><br><br>Thanks,<br>
{{ config('app.name') }}
@endcomponent
