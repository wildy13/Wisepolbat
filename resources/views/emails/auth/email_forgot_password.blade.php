@component('mail::message')
# Hello !
<p>Anda menerima email ini karena kami telah menerima sebuah permintaan pengaturan ulang kata sandi dari akun anda.</p>

@component('mail::button', ['url' => $action_link])
Reset Password
@endcomponent

<p>Jika Anda tidak meminta pengaturan ulang kata sandi, biarkan email ini</p>

<br>Thanks,<br>
{{ config('app.name') }}
@endcomponent
