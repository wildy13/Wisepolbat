@extends('Dashboard.Layouts.main')

@section('konten')
    <div class="card formPengaduan">
        <div class="card-header">
            Revisi Laporan
        </div>
        <div class="container">
            <form class="formPengaduan" action="/dashboard/report/{{ $report->id }}" method="POST">
                @method('put')
                @csrf
                    <div class="form-group">
                        <label for="kategori">Kategori Kasus</label>
                        <select class="custom-select" id="kategori" name="category">
                            <?php 
                                $categories = ["Tindak Pidana Korupsi", "Kepegawaian", "Kekerasan Seksual", "Bullying / Perundungan", "Intoleransi"];

                                // echo "<option value=". $categories[3] .">".$categories[3]."</option>";

                                foreach ($categories as $item) {
                                    if ($item == $report->category) {
                                        echo "<option selected value='".$report->category."'>".$report->category."</option>";
                                    }else {
                                        echo "<option value='".$item."''>".$item."</option>";
                                    };
                                };
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="judulPengaduan">Judul Pengaduan</label>
                        <input type="text" name="title" class="form-control" id="judulPengaduan" value="{{ $report->title }}">
                    </div>
                    <div class="form-group">
                        <label for="uraianPengaduan">Uraian Pengaduan</label>
                        <input id="body" class="@error('description') is-invalid @enderror" type="hidden" name="description" value="{{ $report->description }}">
                        <trix-editor input="body"></trix-editor>
                        @error('description')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group tambah" id="tambahTerlapor">
                        <label for="terlapor">Pihak Yang Diduga Terkait</label>
                    </div>
                    @foreach ($report->suspect as $item)
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="nama[]" class="form-control" id="validationDefault03" placeholder="Nama Lengkap" value="{{ $item[0] }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <input type="text" name="jabatan[]" class="form-control" id="validationDefault05" placeholder="Jabatan" value="{{ $item[1] }}" required>
                            </div>
                            <div class="col-md-2 mb-3">
                                <select class="custom-select" id="validationDefault04" name="klasifikasi[]" required>
                                    <?php
                                        $klasifikasi = ['PNS', 'Non PNS'];
                                        foreach ($klasifikasi as $kl) {
                                            if ($kl === $item[2]) {
                                                echo "<option selected value='".$item[2]."'>". $item[2] ."</option>";
                                            }else {
                                                echo "<option value='".$kl."'>". $kl ."</option>";
                                            };
                                        };
                                    ?>
                                </select>
                            </div>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <label for="btnTambahLampiran">Lampiran</label>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('downloadFile', $report->id) }}" class="btn btn-lg bg-dark px-4 py-1 rounded border-0" id="btn-download-lampiran"><i class="fas fa-file-download"></i>Download</a>
                    </div>
                    <div class="form-group notice">
                        <span>Perhatian :</span>
                        <p>Sebelum mengirim pengaduan ini, mohon diingat bahwa hanya pengaduan yang memenuhi kriteria yang akan diproses lebih lanjut
                            dan kami mengharapkan keseriusan pengaduan dengan melampirkan data pendukung yang memadai. Dengan mengklik "Kirim" berarti
                            anda telah setuju pada syarat dan ketentuan yang berlaku pada POLIBATAM Whisltleblowing System.
                        </p>
                    </div>
                    <div class="form-group button mt-5" id="tombolPengaduan">
                        <a href="/dashboard/report" class="btn btnReset"><i class="fas fa-times"></i>Batal</a>
                        <button type="button" class="btn btnSubmit" data-toggle="modal" data-target="#modalRevisi"><i class="far fa-paper-plane"></i>Revisi Laporan</button>                
                    </div>
        </div>
    </div>

    <!-- START MODAL REVISI -->
    <div class="modal fade modalDelete" id="modalRevisi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <p>Apakah anda yakin ingin merevisi laporan ini ?</p>
                </div>
                <div class="modal-footer">
                        <input type="hidden" name="revisi" value="{{ TRUE }}">
                        <button type="button" class="btn btnClose" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btnDelete">Revisi Laporan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL REVISI -->
@endsection