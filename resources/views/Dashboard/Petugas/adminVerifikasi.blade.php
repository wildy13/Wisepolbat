@extends('Dashboard.Layouts.main')

@section('konten')
    <div class="card formPengaduan">
        <div class="card-header">
            Verifikasi Aduan
        </div>
        <div class="container">
            <form class="formPengaduan">
                <fieldset disabled>
                    <div class="form-group">
                        <label for="kategori">Kategori Kasus</label>
                        <select class="custom-select" id="kategori" name="category">
                            <option value="">{{ $report->category }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="judulPengaduan">Judul Pengaduan</label>
                        <input type="text" name="title" class="form-control" id="judulPengaduan" value="{{ $report->title }}">
                    </div>
                    <div class="form-group">
                        <label for="uraianPengaduan">Uraian Pengaduan</label>
                        <textarea class="form-control" id="uraianPengaduan" rows="10">{{ $report->description }}</textarea>
                    </div>
                    <div class="form-group tambah" id="tambahTerlapor">
                        <label for="terlapor">Pihak Yang Diduga Terkait</label>
                    </div>
                    @foreach ($report->suspect as $item)
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="nama[]" class="form-control" id="validationDefault03" placeholder="Nama Lengkap" value="{{ $item[0] }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <input type="text" name="jabatan[]" class="form-control" id="validationDefault05" placeholder="Jabatan" value="{{ $item[1] }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <select class="custom-select" id="validationDefault04" name="klasifikasi[]">
                                    <option selected>{{ $item[2] }}</option>
                                </select>
                            </div>
                        </div>
                    @endforeach

                    </fieldset>
                    <div class="form-group">
                        <label for="btnTambahLampiran">Lampiran</label>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('downloadFile', $report->id) }}" class="btn btn-lg bg-dark px-4 py-1 rounded border-0" id="btn-download-lampiran"><i class="fas fa-file-download"></i>Download</a>
                    </div>
                    <div class="form-group notice">
                        <span>Perhatian :</span>
                        <p>Sebelum menerima laporan ini, mohon diingat bahwa hanya pengaduan yang memenuhi kriteria yang akan diproses lebih lanjut. Dengan mengklik "Terima Laporan" berarti laporan telah sesuai dengan syarat dan ketentuan yang berlaku pada POLIBATAM Whisltleblowing System.
                        </p>
                    </div>
                    <div class="form-group button mt-5" id="tombolPengaduan">
                        <button type="button" class="btn btnReset" data-toggle="modal" data-target="#modalTolak"><i class="fas fa-window-close"></i>Tolak Laporan</button>
                        <button type="button" class="btn btnSubmit" data-toggle="modal" data-target="#modalTerima"><i class="fas fa-check-square"></i>Terima Laporan</button>                
                    </div>
            </form>
        </div>
    </div>

     {{-- END MODAL TOLAK --}}
     <div class="modal fade" id="modalTolak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Alasan Penolakan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/dashboard/tanggapan" method="POST">
                @csrf
                <input type="hidden" name="adminTolakLaporan" value="{{ TRUE }}">
                <input type="hidden" name="is_petugas" value="{{ TRUE }}">
                <input type="hidden" name="level" value="admin_pelapor">
                <input type="hidden" name="reportId" value="{{ $report->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Alasan Penolakan :</label>
                        <input id="body" class="@error('pesan') is-invalid @enderror" type="hidden" name="pesan">
                        <trix-editor input="body"></trix-editor>
                        @error('pesan')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send message</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    {{-- END MODAL TOLAK --}}

    <!-- START MODAL TERIMA -->
    <div class="modal fade modalDelete" id="modalTerima" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <p>Jika anda menerima laporan, berarti laporan ini akan diproses lebih lanjut ke tahap Verifikasi
                    </p>
                </div>
                <div class="modal-footer">
                    <form action="/dashboard/report/{{ $report->id }}" method="POST">
                        @method('put')
                        @csrf
                        <input type="hidden" name="adminTerimaLaporan" value="{{ TRUE }}">
                        <button type="button" class="btn btnClose" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btnDelete">Terima Laporan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL TERIMA -->
@endsection