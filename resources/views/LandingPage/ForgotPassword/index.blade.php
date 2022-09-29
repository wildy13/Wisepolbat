@extends('LandingPage.Layouts.main')
@section('konten')
    <div class="wrapper">
        <div class="loginRegister">
            <div class="cont">
                <div class="containerHeader">
                    <hr class="garisHeader">
                    <span class="header">Lupa Password</span>
                </div>
                <form class="formLoginRegister" action="{{ route('forgotPasswordLink') }}" method="POST">
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
                        <label>Level</label>
                        <select class="custom-select @error('level') is-invalid @enderror" name="level">
                            <option selected disabled value="">Pilih</option>
                            <option value="petugas">Petugas</option>
                            <option value="pelapor">Pelapor</option>
                        </select>
                        @error('level')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" aria-describedby="emailHelp">
                        @error('email')
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