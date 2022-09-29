@extends('Dashboard.Layouts.main')

@section('konten')
<div class="tableResponsive">
    <table class="table table-striped tableListPengaduan">
        <caption class="caption">Pengaduan</caption>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kategori</th>
                <th scope="col">Judul</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($reports as $report)
            <tr>
                <td data-label="No">{{ $loop->iteration }}</td>
                <td data-label="Kategori">{{ $report->category }}</td>
                <td data-label="Judul">{{ $report->title }}</td>
                <td data-label="Tanggal"><?php $date = explode(" ", $report->created_at);
                                            echo $date[0] ?></td>
                <td data-label="Status" class="status <?php if ($report->status == 'Belum Disetujui') {
                                                            echo 'kuning';
                                                        } else if ($report->status == 'Verifikasi') {
                                                            echo 'biru';
                                                        } else {
                                                            echo 'hijau';
                                                        }; ?>">
                    <span>{{ $report->status }}</span>
                </td>
                <td class="td-btn">
                    @if ($report->status !== 'Selesai')
                        <button type="button" class="btn btnDetail" data-toggle="modal" data-target="#modalInfo{{ $report->id }}"><i class="fas fa-info-circle"></i></button>
                    @endif
                    @can('admin')
                        @if ($report->status == 'Belum Disetujui')
                            <a href="/dashboard/report/{{ $report->id }}/edit" class="btn btnDelete"><i class="fas fa-sync-alt"></i></a>
                        @endif
                    @endcan
                    @can('pelapor')
                        @if ($report->status == 'Belum Disetujui' || $report->status == 'Ditolak')
                            <button type="button" class="btn btnDetail" data-toggle="modal" data-target="#modalDelete{{ $report->id }}"><i class="fas fa-minus-circle"></i></button>
                        @endif
                        @if ($report->status == 'Verifikasi' || $report->status == 'Revisi')
                            <button type="button" class="btn btnDetail" data-toggle="modal" data-target="#modalTanggapan{{ $report->id }}"><i class="fas fa-comments"></i></button>
                        @endif
                    @endcan

                    @can('manajemen')
                        @if ($report->status !== 'Belum Disetujui' && $report->status !== 'Ditolak' && $report->status !== 'Selesai')
                            <button type="button" class="btn btnDetail" data-toggle="modal" data-target="#modalTanggapan{{ $report->id }}"><i class="fas fa-comments"></i></button>
                        @endif
                        @if ($report->status == 'Verifikasi' || $report->status == 'Revisi')
                            <button type="button" class="btn btnDelete" data-toggle="modal" data-target="#modalVerifikasi{{ $report->id }}"><i class="fas fa-sync-alt"></i></button>
                        @endif
                        @if ($report->status == 'Revisi')
                            <a href="/dashboard/report/{{ $report->id }}/edit" class="btn btnDelete"><i class="fas fa-edit"></i></a>
                        @endif
                        @if ($report->status === 'Selesai')
                            <button type="button" class="btn btnDetail border-0" data-toggle="modal" data-target="#modalHasilInvestigasi{{ $report->id }}"><i class="fas fa-clipboard"></i></button>
                        @endif
                    @endcan

                    @can('investigasi')
                        @if ($report->status == 'Revisi' || $report->status == 'Persetujuan Investigasi')
                            <button type="button" class="btn btnDetail" data-toggle="modal" data-target="#modalTanggapan{{ $report->id }}"><i class="fas fa-comments"></i></button>
                        @endif
                        @if ($report->status == 'Persetujuan Investigasi' || $report->status == 'Investigasi')
                            <button type="button" class="btn btnDelete" data-toggle="modal" data-target="#modalInvestigasi{{ $report->id }}"><i class="fas fa-sync-alt"></i></button>
                        @endif
                        @if ($report->status == 'Selesai')
                            <button type="button" class="btn btnDetail" data-toggle="modal" data-target="#modalDelete{{ $report->id }}"><i class="fas fa-trash-alt"></i></button>
                        @endif
                    @endcan
                </td>
                <!-- START MODAL INFO -->
                <div class="modal fade modalDelete" id="modalInfo{{ $report->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Informasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <i class="fas fa-exclamation"></i>
                                <p>
                                    Silahkan tekan tombol "Download Laporan" di bawah ini untuk melihat informasi lengkap dari laporan ini.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('zipFileDownload', $report->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="downloadLaporan" value="{{ TRUE }}">
                                    <button type="button" class="btn btnClose" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btnDelete">Download Laporan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODAL INFO -->

                <!-- START MODAL HASIL INVESTIGASI -->
                <div class="modal fade modalDelete" id="modalHasilInvestigasi{{ $report->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hasil Investigasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <i class="fas fa-exclamation"></i>
                                <p>
                                    Silahkan tekan tombol "Download" di bawah ini untuk melihat hasil investigasi dari laporan ini.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('zipFileDownload', $report->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="downloadHasilInvestigasi" value="{{ TRUE }}">
                                    <button type="button" class="btn btnClose" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btnDelete">Download</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODAL HASIL INVESTIGASI -->

                <!-- START MODAL TANGGAPAN-->
                <div class="modal fade modalInfo modalTanggapan" id="modalTanggapan{{ $report->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tanggapan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body tanggapanBody" id="tanggapanBody">
                                <div class="tanggapanManajemenPelapor">
                                    @foreach ($report->tanggapans as $tanggapan)
                                    @if ($tanggapan->level == 'manajemen_pelapor')

                                    @if(Auth::guard('pelapor')->check())
                                    @if($tanggapan->user_id == Auth::user()->id)
                                    <div class="form-row saya">
                                        <div class="col">
                                            <span> <b>Saya :</b> {!! $tanggapan->pesan !!}</span>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-row bukanSaya">
                                        <div class="col">
                                            <span> <b>Manajemen :</b> {!! $tanggapan->pesan !!}</span>
                                        </div>
                                    </div>
                                    @endif
                                    @else
                                    @if($tanggapan->petugas_id == Auth::user()->id)
                                    <div class="form-row saya">
                                        <div class="col">
                                            <span> <b>Saya :</b> {!! $tanggapan->pesan !!}</span>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-row bukanSaya">
                                        <div class="col">
                                            <span> <b>Pelapor :</b> {!! $tanggapan->pesan !!}</span>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                                <div class="tanggapanManajemenInvestigasi">
                                    @foreach ($report->tanggapans as $tanggapan)
                                    @if ($tanggapan->level == 'manajemen_investigasi')
                                    @if($tanggapan->petugas_id == Auth::user()->id)
                                    <div class="form-row saya">
                                        <div class="col">
                                            <span> <b>Saya :</b> {!! $tanggapan->pesan !!}</span>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-row bukanSaya">
                                        <div class="col">
                                            <span> <b>{!! $tanggapan->petugas->name !!} :</b> {!! $tanggapan->pesan !!}</span>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="container px-5">
                                <form action="/dashboard/tanggapan" method="POST">
                                    @csrf
                                    @if(Auth::guard('pelapor')->check())
                                    <input type="hidden" name="is_pelapor" value="{{ TRUE }}">
                                    @endif
                                    @if(Auth::guard('petugas')->check())
                                    <input type="hidden" name="is_petugas" value="{{ TRUE }}">
                                    @endif
                                    <input type="hidden" name="reportId" value="{{ $report->id }}">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Recipient :</label>
                                        <select class="custom-select penerimaTanggapan" id="penerimaTanggapan" name="level" onchange="tanggapan(this.value, parentElement.parentElement.previousElementSibling)">
                                            <option selected disabled>Pilih Penerima</option>
                                            @can('manajemen')
                                            @if ($report->status == 'Revisi' || $report->status == 'Persetujuan Investigasi')
                                            <option value="manajemen_investigasi">Tim Investigasi</option>
                                            @endif
                                            @if ($report->status == 'Verifikasi' || $report->status == 'Revisi')
                                            <option value="manajemen_pelapor">Pelapor</option>
                                            @endif
                                            @endcan
                                            @can('investigasi')
                                            @if ($report->status == 'Revisi' || $report->status == 'Persetujuan Investigasi')
                                            <option value="manajemen_investigasi">Manajemen</option>
                                            @endif
                                            @endcan
                                            @can('pelapor')
                                            @if ($report->status == 'Verifikasi' || $report->status == 'Revisi')
                                            <option value="manajemen_pelapor">Manajemen</option>
                                            @endif
                                            @endcan
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea class="form-control" name="pesan" id="message-text"></textarea>
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
                <div class="modal fade modalDelete" id="modalDelete{{ $report->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <p> {{ ($report->status == 'Belum Disetujui') ? 'Jika anda menghapus aduan, berarti aduan ini akan dibatalkan dan tidak akan
                                        diproses lebih lanjut.' : 'Anda yakin ingin mengahapus laporan ini ?' }}
                                </p>
                            </div>
                            <div class="modal-footer">
                                <form action="/dashboard/report/{{ $report->id }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="button" class="btn btnClose" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btnDelete">Hapus Laporan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODAL DELETE -->

                <!-- START MODAL VERIFIKASI -->
                <div class="modal fade modalDelete" id="modalVerifikasi{{ $report->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    {{ ($report->status == 'Verifikasi') ? 'Jika anda memverifikasi laporan, berarti aduan ini akan diproses lebih lanjut ke tahap investigasi.' : 'Apakah perevisian laporan telah selesai ?' }}
                                </p>
                            </div>
                            <div class="modal-footer">
                                <form action="/dashboard/report/{{ $report->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    @if ($report->status == 'Revisi')
                                    <input type="hidden" name="revisiSelesai" value="{{ TRUE }}">
                                    @endif
                                    @if ($report->status == 'Verifikasi')
                                    <input type="hidden" name="persetujuanInvestigasi" value="{{ TRUE }}">
                                    <button type="button" class="btn btnClose" data-dismiss="modal" data-toggle="modal" data-target="#modalTolak{{ $report->id }}">Tolak Laporan</button>
                                    @endif
                                    <button type="submit" class="btn btnDelete">{{ ($report->status == 'Verifikasi') ? 'Verifikasi Laporan' : 'Revisi Selesai' }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODAL VERIFIKASI -->

                {{-- END MODAL TOLAK --}}
                <div class="modal fade" id="modalTolak{{ $report->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="hidden" name="is_petugas" value="{{ TRUE }}">
                                <input type="hidden" name="reportId" value="{{ $report->id }}">
                                <input type="hidden" name="level" value="manajemen_pelapor">
                                <input type="hidden" name="manajemenTolakLaporan" value="{{ TRUE }}">
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

                <!-- START MODAL INVESTIGASI -->
                <div class="modal fade modalDelete" id="modalInvestigasi{{ $report->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered {{ ($report->status == 'Investigasi') ? 'modal-lg' : ''}}">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ ($report->status == 'Investigasi') ? 'Hasil Investigasi' : 'Peringatan'}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body {{ ($report->status == 'Investigasi') ? 'text-left' : ''}}">
                                @if ($report->status == 'Persetujuan Investigasi')
                                <i class="fas fa-exclamation"></i>
                                <p>{!!'Jika anda Terima Laporan, berarti aduan ini akan diinvestigasi. Namun jika laporan masih ada yang perlu diperbaiki silahkan ajukan Revisi Laporan'!!}</p>
                                @endif

                                @if ($report->status == 'Investigasi')
                                <form action="/dashboard/report/{{ $report->id }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="deskripsiInvestigasi">Deskripsi :</label>
                                        <textarea class="w-100" rows="8" name="investigation_note" id="deskripsiInvestigasi"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="fileInvestigasi">Berkas Hasil Investigasi :</label>
                                            <input type="file" name="investigation_result_attachment" class="form-control-file" id="fileInvestigasi">
                                        </div>
                                    </div>
                                    @endif
                            </div>
                            <div class="modal-footer">
                                @if ($report->status == 'Persetujuan Investigasi')
                                <form action="/dashboard/report/{{ $report->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="revisiLaporan" value="{{ TRUE }}">
                                    <button type="submit" class="btn btnClose">Revisi Laporan</button>
                                </form>
                                <form action="/dashboard/report/{{ $report->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="investigasiLaporan" value="{{ TRUE }}">
                                    <button type="submit" class="btn btnDelete">Terima Laporan</button>
                                </form>
                                @endif
                                @if ($report->status == 'Investigasi')
                                <button type="button" class="btn btnClose" data-dismiss="modal">Tutup</button>
                                @method('put')
                                @csrf
                                <input type="hidden" name="investigasiSelesai" value="{{ TRUE }}">
                                <button type="submit" class="btn btnDelete">Investigasi Selesai</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODAL INVESTIGASI -->

                <!-- START MODAL HASIL INVESTIGASI -->
                {{-- <div class="modal fade modalDelete" id="modalHasilInvestigasi{{ $report->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hasil Investigasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-left">
                            <form action="/dashboard/report/{{ $report->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="deskripsiInvestigasi">Deskripsi :</label>
                                    <textarea class="w-100" rows="8" name="investigation_note" id="deskripsiInvestigasi" disabled>{{ $report->investigation_note }}</textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="btnTambahLampiran">Lampiran</label>
                                </div>
                                <div class="form-group mt-0">
                                    <a class="btn btn-primary bg-dark border-0" href="{{ route('downloadFile', $report->id) }}" role="button"><i class="fas fa-file-download mr-2"></i>Download</a>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btnClose" data-dismiss="modal">Tutup</button>
                            </form>
                        </div>
                    </div>
                </div>
</div> --}}
<!-- END MODAL HASIL INVESTIGASI -->
</tr>
@empty
<tr>
    <td colspan="6 text-center" class="text-center">Tidak Ada Aduan</td>
</tr>
@endforelse
</tbody>
</table>
</div>
@if (isset($report))
<script>
    function tanggapan(selected, body) {
        if (selected == 'manajemen_investigasi') {
            body.children[0].style.display = "none";
            body.children[1].style.display = "block";
        };

        if (selected == 'manajemen_pelapor') {
            body.children[1].style.display = "none";
            body.children[0].style.display = "block";
        }
        body.scrollTo(0, body.scrollHeight);
    };
</script>
@endif
@endsection