<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap-4.5.3/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Dashboard.css') }}">

    <!-- Font Awesome -->
    <link href="{{ asset('fontawesome5.15.4/css/all.css') }}" rel="stylesheet">
    <title>WISE POLIBATAM</title>

    {{-- Captcha API --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    {{-- trix text editor --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
    <style>
        trix-toolbar [data-trix-button-group="file-tools"]{
            display: none;
        }
    </style>

</head>

<body>
    @include('Dashboard.Partials.navTop')
    @include('Dashboard.Partials.sideBar')

    <!-- BAGIAN CONTENT -->
    <div class="content pelapor">
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
            
        @yield('konten')
    </div>
    <!-- END BAGIAN CONTENT -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="{{ asset('bootstrap-4.5.3/js/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('bootstrap-4.5.3/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap-4.5.3/js/popper.min.js') }}"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

    <!-- Other JavaScript -->
    <script src="{{ asset('js/dasboard.js') }}"></script>

    {{-- Captcha JS --}}
    <script src="{{ asset('js/recaptcha.js') }}"></script>

    {{-- trix text editor --}}
    <script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>
    <script>
        // Perubahan pada nomor 11
          document.addEventListener('trix-file-accept', function(e){
                e.preventDefault();
          })
    </script>

    {{-- FAQ --}}
    <script src="{{ asset('js/faq.js') }}"></script>
</body>

</html>