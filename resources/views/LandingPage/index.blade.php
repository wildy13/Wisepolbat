<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap-4.5.3/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/HomeLoginRegister.css') }}">

    <!-- Font Awesome -->
    <link href="{{ asset('fontawesome5.15.4/css/all.css') }}" rel="stylesheet">
    <title>WISE POLIBATAM</title>
</head>

<body data-spy="scroll" data-target="#navbar-example2" data-offset="0">
        <nav id="navbar-example2" class="navbar fixed-top navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="/">
                <img src="img/logoPolbat.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav nav nav-pills">
                <li class="nav-item">
                <a class="nav-link item" href="#home">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Informasi</a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item item" href="#tentang_wise">Tentang Whistleblowing</a>
                    <a class="dropdown-item item" href="#tata_cara">Tata Cara Pengaduan</a>
                    </div>
                </li>
                <li class="nav-item">
                <a class="nav-link item" href="#bantuan">Bantuan</a>
                </li>
                <li class="nav-item login">
                <a class="nav-link item login" href="{{ route('login') }}">Login</a>
                </li>
            </ul>
            </div>
        </nav>
        <!-- BAGIAN HOME -->
        <div class="jumbotron" id="home" style="background-image: url('{{ asset('img/bgJumbotron.png') }}')">
            <div class="container">
                <h1 class="display-5">SELAMAT DATANG DI</h1>
                <h1 class="display-5">WHISTLEBLOWING SYSTEM</h1>
                <h1 class="display-5">POLITEKNIK NEGERI BATAM</h1>
                <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Buat Pengaduan</a>
            </div>
        </div>
        <!-- END BAGIAN HOME -->

        <!-- TENTANG WBS -->
        <div class="tentangWBS mobile" id="tentang_wise">
            <div class="container judulTentangWBS">
                <hr class="garisJudul">
                <span class="judul mobile">Whistleblowing System</span>
            </div>
            <div class="container kontenTentangWBS mobile">
                <p class="konten">Whistleblowing System merupakan aplikasi yang ditujukan untuk anda yang memiliki dan ingin melaporkan suatu perbuatan berindikasi pelanggaran yang terjadi di lingkungan Politeknik Negeri Batam</p>
            </div>
        </div>
        <!-- END TENTANG WBS -->

        <!-- BAGIAN TATA CARA PENGADUAN -->
        <div class="tataCaraPengaduan" id="tata_cara">
            <div class="container judulTataCaraPengaduan">
                <hr class=" garisJudul">
                <span class="judul mobile">Tata Cara Pengaduan</span>
            </div>
            <div class="container kontenTataCaraPengaduan">
                <div class="row">
                    <div class="col-md">
                        <div class="card tata-cara-pengaduan">
                            <div class="card-body">
                                <h5 class="card-title">1</h5>
                                <span class="highlight">Login</span>
                                <p class="card-text">
                                    Jika belum mempunyai akun silahkan daftar terlebih dahulu, kemudian Login !
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card tata-cara-pengaduan">
                            <div class="card-body">
                                <h5 class="card-title">2</h5>
                                <span class="highlight">Isi Form Pengaduan</span>
                                <p class="card-text">
                                    Klik tombol "Buat Pengaduan" dan lanjutkan dengan mengisi formulir pengduan
                                    yang telah disediakan dan lanjutkan dengan menekan tombol "Kirim Pengaduan"
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card tata-cara-pengaduan">
                            <div class="card-body">
                                <h5 class="card-title">3</h5>
                                <span class="highlight">Pantau Pengaduan</span>
                                <p class="card-text">
                                    Anda dapat memantau pengaduan yang telah anda kirim, membuat pengaduan baru dan juga dapat melakukan komunikasi
                                    secara pribadi dengan administrator WBS melalui halaman khusus pelapor
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END BAGIAN TATA CARA PENGDUAN -->


        <!-- BAGIAN BANTUAN -->
        <div class="bantuan" id="bantuan">
            <div class="container judulBantuan">
                <hr class="garisJudul">
                <span class="judul">Hubungi Kami</span>
            </div>               
            <div class="container kontenBantuan">
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
                <h1 class="panduan">Silahkan Anda membaca informasi berikut terlebih dahulu :</h1>
                <ul>
                    <li>Fitur ini digunakan hanya untuk menanyakan sesuatu yang berhubungan dengan aplikasi WBS POLIBATAM.</li>
                    <li>Sebelum mengisi formulir <span class="bold">"hubungi kami"</span> pastikan Anda telah membaca informasi-informasi yang telah disampaikan.</li>
                    <li>Pastikan data/informasi yang diinput pada formulir <span class="bold">"hubungi kami"</span> dapat dimengerti.</li>
                    <li>Jawaban atas pertanyaan Anda akan direspon melalui email.</li>
                </ul>
                <form class="formPanduan" action="/pesanbantuan" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="namaLengkap">Nama Lengkap</label>
                            <input type="text" class="form-control @error('author_name') is-invalid @enderror" name="author_name" placeholder="* Sesuai dengan KTP">
                            @error('author_name')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="* Email aktif & valid">
                            @error('email')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pesan">Pesan</label>
                        <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="pesan" rows="10" placeholder="* Silahkan tuliskan pesan anda (Maksimum 400 karakter)"></textarea>
                        @error('message')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" onclick="checkFormBantuan()">
                            <label class="form-check-label" for="gridCheck">
                                Data yang saya berikan benar dan dapat dipertanggungjawabkan
                            </label>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btnCheckBantuan">Kirim Pesan</button>
                </form>
            </div>
        </div>
        <!-- END BAGIAN BANTUAN -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="{{ asset('bootstrap-4.5.3/js/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('bootstrap-4.5.3/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap-4.5.3/js/bootstrap.min.js') }}"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

    <!-- Other JavaScript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>