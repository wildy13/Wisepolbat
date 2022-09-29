@extends('Dashboard.Layouts.main')

@section('konten')
    <div class="card formPengaduan">
        <div class="card-header">
            Form Pengaduan
        </div>
        <div class="container">
            <form class="formPengaduan" action="/dashboard/report" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="kategori">Kategori Kasus</label>
                    <select class="custom-select @error('category') is-invalid @enderror" id="kategori" name="category">
                        <option selected disabled value="">Pilih Kategori</option>
                        <option value="Tindak Pidana Korupsi">Tindak Pidana Korupsi</option>
                        <option value="Kepegawaian">Kepegawaian</option>
                        <option value="Kekerasan Seksual">Kekerasan Seksual</option>
                        <option value="Bullying / Perundungan">Bullying / Perundungan</option>
                        <option value="Intoleransi">Intoleransi</option>
                    </select>
                    @error('category')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="judulPengaduan">Judul Pengaduan</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="judulPengaduan">
                    @error('title')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="uraianPengaduan">Uraian Pengaduan</label>
                    <input id="body" class="@error('description') is-invalid @enderror" type="hidden" name="description">
                    <trix-editor input="body"></trix-editor>
                    @error('description')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group tambah" id="tambahTerlapor">
                    <label for="terlapor">Pihak Yang Diduga Terkait</label>
                    <button type="button" class="btnTambah" id="btnTambahTerlapor"><i class="fas fa-plus"></i>Tambah</button>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <input type="text" name="nama[]" class="form-control @error('nama[]') is-invalid @enderror" id="validationDefault03" placeholder="Nama Lengkap" required>
                        @error('nama[]')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" name="jabatan[]" class="form-control @error('jabatan[]') is-invalid @enderror" id="validationDefault05" placeholder="Jabatan" required>
                        @error('jabatan[]')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <select class="custom-select @error('klasifikasi[]') is-invalid @enderror" id="validationDefault04" name="klasifikasi[]" required>
                            <option selected disabled value="">Klasifikasi</option>
                            <option value="PNS">PNS</option>
                            <option value="Non PNS">Non PNS</option>
                        </select>
                        @error('klasifikasi[]')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-1 mb-3 colDelete">
                        <i class=" fas fa-trash-alt btnDelete"></i>
                    </div>
                </div>
                <div id="addLaporan"></div>
                <div class="form-row">
                    <div class="col-md mb-3">
                        <label for="btnTambahLampiran">Lampiran</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input inputLampiran @error('lampiran') is-invalid @enderror" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="lampiran">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        @error('lampiran')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group notice" id="catatanLampiran">
                    <span>Catatan</span>
                    <ul>
                        <li>Ukuran total file maksimal 100 MB</li>
                        <li>Format yang dikirimkan : zip | doc | docx | pdf | png | rar | mp3 | mp4 | gif | pptx | mov | 3gp</li>
                    </ul>
                </div>
                <div class="form-row mt-4">
                    <div class="col-md-6 mb-3">
                        <label for="judulPengaduan">Captcha</label>
                        <div class="g-recaptcha @error('grecaptcha') is-invalid @enderror" data-sitekey="{{ env('GOOGLE_CAPTCHA_KEY') }}" data-callback="recaptchaDataCallbackLogin" data-expired-callback="recaptchaExpireCallbackLogin"></div>
                        <input type="hidden" name="grecaptcha" id="hiddenRecaptchaLogin">
                        @error('grecaptcha')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group notice">
                    <span>Perhatian :</span>
                    <p>Sebelum mengirim pengaduan ini, mohon diingat bahwa hanya pengaduan yang memenuhi kriteria yang akan diproses lebih lanjut
                        dan kami mengharapkan keseriusan pengaduan dengan melampirkan data pendukung yang memadai. Dengan mengklik "Kirim" berarti
                        anda telah setuju pada syarat dan ketentuan yang berlaku pada POLIBATAM Whisltleblowing System.
                    </p>
                </div>
                <div class="form-group button mt-5" id="tombolPengaduan">
                    <button type="reset" class="btn btnReset"><i class="fas fa-times"></i>Batal</button>
                    <button type="submit" class="btn btnSubmit"><i class="far fa-paper-plane"></i>Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection