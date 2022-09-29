<div class="alert alert-{{ (count(Auth::user()->unreadNotifications) != 0) ? 'success' : 'secondary' }} alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">Hello !</h4>
    <p> Hi, Laporan anda dengan judul <i>{{ $notification->data['report']['title'] }}</i> telah disetujui. Laporan anda akan diteruskan ke pihak manajemen untuk dilakukan verifikasi.</p>
    <form action="/notification/delete/{{ $notification->id }}" method="GET">
        <button type="submit" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </form>
    <hr>
    <p class="mb-0"><small>{{  $notification->created_at->diffForHumans() }}</small></p>
</div>