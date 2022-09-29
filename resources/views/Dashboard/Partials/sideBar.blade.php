 <!-- START NAVBAR VERTICAL -->
<div class="navVertical" id="navVertical">
    <div class="toggle-button">
        <input type="checkbox" id="toggleInput">
        <i class="fas fa-chevron-right"></i>
    </div>

    <div class="container">
    <div class="navbar-brand">
        <a href="/dashboard">
            <img src="{{ asset('img/polibatam-white.png') }}" alt="">
        </a>
    </div>
    <ul class="nav flex-column verticalMenues">
        <li class="nav-item notification">
            <a class="nav-link" href="/dashboard/notifications">
                <img src="{{ asset('img/lonceng.png') }}" alt="">
                @if (count(Auth::user()->unreadNotifications) !== 0)
                    <span class="badge badge-danger position-absolute">{{ count(Auth::user()->unreadNotifications) }}</span>
                @endif
            </a>
        </li>
        @can('pelapor')
            <li class="nav-item aduanBaru">
                <a class="nav-link" href="/dashboard/report/create">
                    <i class="fas fa-plus"></i>
                    <span>Aduan Baru</span>
                </a>
            </li>
        @endcan
        <li class="nav-item {{ (Auth::guard('petugas')->check()) ? 'aduanBaru' : '' }}">
            <a class="nav-link" href="/dashboard/report">
                {{-- <img src="{{ asset('img/pluit.png') }}" alt=""> --}}
                <i class="fas fa-briefcase"></i>
                <span>{{ (Auth::guard('pelapor')->check()) ? 'Pengaduan Saya' : 'Daftar Pengaduan' }}</span>
            </a>
        </li>
        @can('admin')
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/petugas">
                    <i class="fas fa-users"></i>
                    <span>Akun Petugas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dashboard/pesanbantuan">
                    <i class="fas fa-envelope"></i>
                    <span>Pesan Bantuan</span>
                </a>
            </li>
        @endcan
        @can('pelapor')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('faq') }}">
                    <img src="{{ asset('img/faq.png') }}" alt="">
                    <span>FAQ</span>
                </a>
            </li>
        @endcan
        
    </ul>
    </div>
</div>
<!-- END NAVBAR VERTICAL -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="{{ asset('bootstrap-4.5.3/js/jquery-3.5.1.slim.min.js') }}"></script>
<script>
    function markNotificationAsRead(notificationsCount) {
        if (notificationsCount != 0) {
        $.get('/markasread', function () {
            alert('status');
            alert('HELO Jodi');
        })
        }
    }
</script>
