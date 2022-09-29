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
          <a class="nav-link item" href="/#home">Home</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Informasi</a>
            <div class="dropdown-menu">
              <a class="dropdown-item item" href="/#tentang_wise">Tentang Whistleblowing</a>
              <a class="dropdown-item item" href="/#tata_cara">Tata Cara Pengaduan</a>
            </div>
        </li>
        <li class="nav-item">
          <a class="nav-link item" href="/#bantuan">Bantuan</a>
        </li>
        <li class="nav-item login">
          <a class="nav-link item login" href="{{ route('login') }}">Login</a>
        </li>
      </ul>
    </div>
  </nav>