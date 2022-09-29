@extends('Dashboard.Layouts.main')

@section('konten')
  <div class="card profilPelapor">
    <div class="card-header">
        Profil Saya
    </div>
    <div class="container menu">
        <ul class="menu">
            <a href="/dashboard/profil">
                <li class="menu-item active">Akun</li>
            </a>
            <a href="/dashboard/password">
                <li class="menu-item">Ganti Password</li>
            </a>
        </ul>
    </div>
    <div class="container">
        <form class="formProfil pelapor" action="/dashboard/profil" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- <div class="col-md-5 colFotoProfil">
                    <img class="fotoProfil" src="../All Support/img/userIcon.png" alt="">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Foto</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                </div> --}}
                <div class="col-md">
                        <div class="form-group">
                            <label for="judulPengaduan">Fullname</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                        </div>
                        @can('petugas')
                            <div class="form-group">
                                <label for="judulPengaduan">Username</label>
                                <input type="text" class="form-control" disabled value="{{ $user->username }}">
                            </div>
                        @endcan
                        @can('pelapor_internal')
                            <div class="form-group">
                                <label for="judulPengaduan">NIM/NID</label>
                                <input type="text" class="form-control" disabled value="{{ $user->nim_or_nid }}">
                            </div>
                        @endcan
                        <div class="form-group">
                            <label for="judulPengaduan">Email</label>
                            <input type="text" class="form-control" disabled value="{{ $user->email }}">
                        </div>
                        <div class="form-group button mt-5" id="tombolPengaduan">
                            <button type="reset" class="btn btnReset"><i class="fas fa-times"></i>Batal</button>
                            <button type="submit" class="btn btnSubmit"><i class="fas fa-user-edit"></i>Ubah</button>
                        </div>
                </div>
            </div>
        </form>
    </div>
  </div>      

@endsection