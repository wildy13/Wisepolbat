@extends('Dashboard.Layouts.main')

@section('konten')

      @if (count(Auth::user()->unreadNotifications) != 0)
          @foreach (Auth::user()->unreadNotifications as $notification)
            @include('Dashboard.Partials.Notifications.' .class_basename($notification->type))
          @endforeach
      @else    
          @if (count(Auth::user()->readNotifications) != 0)
              @foreach (Auth::user()->readNotifications as $notification)
                @include('Dashboard.Partials.Notifications.' .class_basename($notification->type))
              @endforeach

            @else
                <div class="list-group">
                  <div class="d-flex w-100 justify-content-center">
                    <p>No Notification Found</p>
                  </div>
                </div>
          @endif
      @endif
@endsection