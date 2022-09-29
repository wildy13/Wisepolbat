@extends('Dashboard.Layouts.main')

@section('konten')
<div class="card profilPelapor">
    <div class="card-header">
        Ganti Password
    </div>
    <div class="container menu">
        <ul class="menu">
            <a href="/dashboard/profil">
                <li class="menu-item">Akun</li>
            </a>
            <a href="/dashboard/password">
                <li class="menu-item active">Ganti Password</li>
            </a>
        </ul>
    </div>
    <div class="container">
        <form class="formProfil pelapor" action="/dashboard/password" method="POST">
            @csrf
            <div class="form-group">
                <label for="judulPengaduan">Password Lama</label>
                <input type="password" name="password_lama" class="form-control">
            </div>
            <div class="form-group">
                <label for="judulPengaduan">Password Baru</label>
                <input type="password" name="password_baru" class="form-control">
            </div>
            <div class="form-group">
                <label for="judulPengaduan">Confirm Password Baru</label>
                <input type="password" name="konfirmasi_password_baru" class="form-control">
            </div>
            <div class="form-group button mt-5" id="tombolPengaduan">
                <button type="reset" class="btn btnReset"><i class="fas fa-times"></i>Batal</button>
                <button type="submit" class="btn btnSubmit"><i class="fas fa-user-edit"></i>Ubah</button>
            </div>
        </form>
    </div>
</div>
@endsection