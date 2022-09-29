@extends('LandingPage.Layouts.main')
@section('konten')

<div class="wrapper">
     <!-- BAGIAN LOGIN PELAPOR -->
    <div class="loginRegister">
        <div class="cont internal">
            <div class="containerHeader">
                <hr class="garisHeader">
                <span class="header">External Register</span>
            </div>
            <form class="formLoginRegister internal" action="{{ route('externalRegister') }}" method="POST">
                @if(session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {!! session('failed') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="namaLengkap">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="namaLengkap" aria-describedby="emailHelp" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="emailHelp" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror                 
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                        @error('password')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">                
                    <div class="form-group col-md-6">
                      <label for="confirmPassword">Confirm Password</label>
                      <input type="password" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror" id="confirmPassword">
                      @error('confirmPassword')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary loginBGBiru mb-2">Daftar</button>
                <a href="{{ route('internalRegister') }}" class="btn btn-primary loginBGKuning m-0">Internal Register</a>
                <span class="daftar mt-2">
                    Sudah Punya Akun ?
                    <a class="daftar m-0" href="{{ route('login') }}">Login</a>
                </span>
            </form>
        </div>
    </div>
    <!-- END BAGIAN LOGIN PELAPOR -->   
</div> 
@endsection
