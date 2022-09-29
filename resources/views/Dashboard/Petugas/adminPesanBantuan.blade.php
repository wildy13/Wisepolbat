@extends('Dashboard.Layouts.main')

@section('konten')
<div class="tableResponsive">
    <table class="table table-striped tableListPengaduan">
        <caption class="caption">Pesan Bantuan</caption>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Pengirim</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($messages as $message)
                <tr>
                    <td data-label="No">{{ $loop->iteration }}</td>
                    <td data-label="Pengirim">{{ $message->author_name }}</td>
                    <td data-label="Tanggal"><?php $date = explode(" ", $message->created_at); echo $date[0] ?></td>
                    <td data-label="Status" class="status {{ ($message->status == 'Belum Ditanggapi') ? 'kuning' : 'biru'}}">
                        <span>{{ $message->status }}</span>
                    </td>
                    
                    <td class="td-btn">
                        <button type="button" class="btn btnDelete" data-toggle="modal" data-target="#modalDelete{{ $message->id }}"><i class="fas fa-minus-circle"></i></button>
                        @if ($message->status === 'Belum Ditanggapi')
                            <button type="button" class="btn btnDetail" data-toggle="modal" data-target="#modalTanggapan{{ $message->id }}"><i class="fas fa-comments"></i></button>
                        @endif          
                    </td>

                    <!-- START MODAL TANGGAPAN-->
                    <div class="modal fade modalInfo" id="modalTanggapan{{ $message->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tanggapan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/dashboard/pesanbantuan/{{ $message->id }}" method="POST">
                                        @method('put')
                                        @csrf
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Recipient :</label>
                                            <input type="hidden" name="email" value="{{ $message->email }}">
                                            <input type="text" class="form-control" value="{{ $message->author_name }}" disabled>
                                        </div>
                                          <div class="form-group">
                                            <label for="message-text" class="col-form-label">Message :</label>
                                            <textarea class="form-control" id="message-text" disabled>{{ $message->message }}</textarea>
                                          </div>
                                          <div class="form-group">
                                            <label for="message-text" class="col-form-label">Reply :</label>
                                            <textarea class="form-control" rows="10" name="reply"></textarea>
                                          </div> 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btnClose" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btnDelete">Kirim Tanggapan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL TANGGAPAN -->
                    
                    <!-- START MODAL DELETE -->
                    <div class="modal fade modalDelete" id="modalDelete{{ $message->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <i class="fas fa-exclamation"></i>
                                    <p> 
                                        Anda yakin ingin mengahapus pesan ini ?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="/dashboard/message/{{ $message->id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btnClose" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btnDelete">Hapus Pesan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL DELETE -->
                </tr>
            @empty
                <tr>
                    <td colspan="6 text-center" class="text-center">Tidak Ada Pesan Masuk</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection