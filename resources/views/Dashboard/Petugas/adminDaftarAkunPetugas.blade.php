@extends('Dashboard.Layouts.main')
@section('konten')
<div class="tableResponsive">
    <a href="/dashboard/petugas/create" class="btn btnKuning">Tambah Petugas <i class="fas fa-plus ml-1"></i></a>
    <table class="table table-striped tableListPengaduan">
        <caption class="caption">Daftar Petugas</caption>
        <thead>
            <tr>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Level</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($pengguna as $petugas)
                @if ($petugas->id !== Auth::user()->id)
                    <tr>
                        <td data-label="Nama">{{ $petugas->name }}</td>
                        <td data-label="Username">{{ $petugas->username }}</td>
                        <td data-label="Level">{{ ($petugas->is_management) ? 'Manajemen' : 'Tim Investigasi' }}</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="6 text-center" class="text-center">Tidak Ada Pengguna</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection