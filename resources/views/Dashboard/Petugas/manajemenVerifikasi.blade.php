@extends('Dashboard.Layouts.main')

@section('konten')
    <div class="card formPengaduan">
        <div class="card-header">
            Verifikasi Laporan
        </div>
        <div class="container">
            <form class="formPengaduan" action="/dashboard/report/{{ $report->id }}" method="POST">
                @method('put')
                @csrf
                    <table class="border-1">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Category Kasus</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Judul Kasus</td>
                                <td class="ml-5">:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Pihak Yang Diduga</td>
                                <td class="ml-5">:</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group button mt-5" id="tombolPengaduan">
                        <a href="/dashboard/report" class="btn btnReset"><i class="fas fa-times"></i>Batal</a>
                        <button type="button" class="btn btnSubmit" data-toggle="modal" data-target="#modalRevisi"><i class="far fa-paper-plane"></i>Verifikasi Laporan</button>                
                    </div>
        </div>
    </div>

    <!-- START MODAL VERIFIKASI -->
    <div class="modal fade modalDelete" id="modalVerifikasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <p>Apakah anda yakin ingin memverifikasi laporan ini ?</p>
                </div>
                <div class="modal-footer">
                        <input type="hidden" name="revisi" value="{{ TRUE }}">
                        <button type="button" class="btn btnClose" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btnDelete">Verifikasi Laporan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL VERIFIKASI -->
@endsection