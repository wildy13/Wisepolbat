@extends('LandingPage.Layouts.main')
@section('konten')

<div class="wrapper">
    <!-- BAGIAN LOGIN PELAPOR -->
    <div class="loginRegister">
        <div class="cont">
            <div class="containerHeader">
                <hr class="garisHeader">
                <span class="header">Login</span>
            </div>
            <form class="formLoginRegister" action="{{ route('login') }}" method="POST">
                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! session('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {!! session('failed') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @csrf
                <div class="form-group">
                    <label for="usernameEmailNimNid">Username / Email / NIM / NID</label>
                    <input type="text" class="form-control @error('usernameEmailNimNid') is-invalid @enderror" name="usernameEmailNimNid" id="usernameEmailNimNid" aria-describedby="emailHelp">
                    @error('usernameEmailNimNid')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                    @error('password')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group mt-5">
                    <label for=""></label>
                    <div class="g-recaptcha @error('grecaptcha') is-invalid @enderror" data-sitekey="{{ env('GOOGLE_CAPTCHA_KEY') }}" data-callback="recaptchaDataCallbackLogin" data-expired-callback="recaptchaExpireCallbackLogin"></div>
                    <input type="hidden" name="grecaptcha" id="hiddenRecaptchaLogin">
                    @error('grecaptcha')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit"class="btn btn-primary loginBGBiru">Login</button>
                <span class="daftar m-0">
                    Belum Punya Akun ?
                    <a class="daftar" href="{{ route('internalRegister') }}">Daftar</a>
                </span>
                <span class="lupaPassword m-0">
                    <a class="lupaPassword" href="{{ route('forgotPassword') }}">Lupa Password ?</a>
                </span>
                
            </form>
        </div>
    </div>
    <!-- END BAGIAN LOGIN PELAPOR -->    
</div>
@endsection
