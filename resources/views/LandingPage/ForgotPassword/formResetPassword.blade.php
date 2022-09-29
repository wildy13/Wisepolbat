@extends('LandingPage.Layouts.main')
@section('konten')
    <div class="wrapper">
        <div class="loginRegister">
            <div class="cont">
                <div class="containerHeader">
                    <hr class="garisHeader">
                    <span class="header">Reset Password</span>
                </div>
                <form class="formLoginRegister" action="{{ route('resetPassword') }}" method="POST">
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
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" aria-describedby="emailHelp" value="{{ $email ?? old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control @error('passwordBaru') is-invalid @enderror" name="passwordBaru" aria-describedby="emailHelp">
                        @error('passwordBaru')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" class="form-control @error('konfirmasiPasswordBaru') is-invalid @enderror" name="konfirmasiPasswordBaru" aria-describedby="emailHelp">
                        @error('konfirmasiPasswordBaru')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit"class="btn btn-primary loginBGBiru">Kirim</button>
                </form>
            </div>
        </div>
    </div>
@endsection