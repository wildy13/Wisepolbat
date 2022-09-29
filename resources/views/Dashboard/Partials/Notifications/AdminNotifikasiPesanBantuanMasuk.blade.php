<div class="alert alert-{{ (count(Auth::user()->unreadNotifications) != 0) ? 'success' : 'secondary' }} alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">Hello !</h4>
    <p> Hi, Ada Pesan Bantuan masuk dengan nama pengirim <i>{{ $notification->data['pesanBantuan']['author_name'] }}</i>. Periksa Sekarang !</p>
    <form action="/notification/delete/{{ $notification->id }}" method="GET">
        <button type="submit" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </form>
    <hr>
    <p class="mb-0"><small>{{  $notification->created_at->diffForHumans() }}</small></p>
</div>