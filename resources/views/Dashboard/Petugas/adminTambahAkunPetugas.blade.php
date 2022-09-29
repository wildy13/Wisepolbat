@extends('Dashboard.Layouts.main')

@section('konten')
  <div class="card profilPelapor">
    <div class="card-header">
        Tambah Petugas
    </div>
    <div class="container">
        <form class="formProfil pelapor" action="/dashboard/petugas" method="POST" enctype="multipart/form-data">
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
                            <label>User Level</label>
                            <select class="custom-select @error('level') is-invalid @enderror" name="level">
                                <option selected disabled value="">Pilih Level</option>
                                <option value="manajemen">Manajemen</option>
                                <option value="investigasi">Tim Investigasi</option>
                            </select>
                            @error('level')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Fullname</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid" @enderror>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror">
                            @error('confirmPassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group button mt-5" id="tombolPengaduan">
                            <button type="reset" class="btn btnReset"><i class="fas fa-undo-alt"></i>Reset</button>
                            <button type="submit" class="btn btnSubmit"><i class="fas fa-plus"></i>Tambahkan</button>
                        </div>
                </div>
            </div>
        </form>
    </div>
  </div>      

@endsection