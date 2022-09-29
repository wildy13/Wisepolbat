 <!--  START NAVBAR FIX-TOP -->
 <nav class="navbar fixed-top justify-content-end navTop">
    <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('img/userIcon.png') }}" alt="">
        </button>
        <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="dropdownMenuButton">
            <p class="dropdown-item font-weight-bold text-center">{{ auth()->user()->name }}</p>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/dashboard/profil"><i class="fas fa-user-alt mr-2"></i></i>Profil Saya</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
            </form>
        </div>
    </div>
</nav>
<!-- END NAVBAR FIX-TOP -->