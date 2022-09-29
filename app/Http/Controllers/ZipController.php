<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use ZipArchive;

class ZipController extends Controller
{
    public function zipFile(Request $request, Report $report)
    {
        if ($request->downloadLaporan) {
            $zip = new zipArchive;
            $fileName = "Dokumen Laporan_$report->title.zip";
            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
                $pihakTerkait = explode(';', $report->suspect);
                $jumlahPihakTerkait = (count($pihakTerkait));
                unset($pihakTerkait[$jumlahPihakTerkait - 1]);
                $suspect = [];
                foreach ($pihakTerkait as $pt) {
                    $pt = explode(',', $pt);
                    $suspect[] = $pt;
                }
                $report->suspect = $suspect;
                $created_at = explode(' ', $report->created_at);
                $pdf = PDF::loadview('Dashboard.pdfReport', [
                    'report' => $report,
                    'created_at' => $created_at[0]
                ])->setpaper('A4', 'landscape');
                Storage::put('temporary_storage/temporary.pdf', $pdf->output());
                $path = Storage::disk('local')->path("public/temporary_storage/temporary.pdf");
                $zip->addFile($path, 'Uraian Laporan.pdf');

                $path = Storage::disk('local')->path("public/$report->file_uploaded");
                $format = explode(".", $report->file_uploaded);
                $file = 'Lampiran Bukti Laporan';
                $file .= '.';
                $file .= $format[1];
                $zip->addFile($path, $file);
                $zip->close();
            }
            Storage::delete('temporary_storage/temporary.pdf');
            return response()->download(public_path($fileName))->deleteFileAfterSend(true);
        }
        if ($request->downloadHasilInvestigasi) {
            $zip = new zipArchive;
            $fileName = "Hasil Investigasi_$report->title.zip";
            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
                $pdf = PDF::loadview('Dashboard.pdfInvestigationNote', [
                    'pesan' => $report->investigation_note
                ])->setpaper('A4', 'potrait');
                Storage::put('temporary_storage/temporary.pdf', $pdf->output());
                $path = Storage::disk('local')->path("public/temporary_storage/temporary.pdf");
                $zip->addFile($path, 'Catatan Investigasi.pdf');

                $path = Storage::disk('local')->path("public/$report->investigation_result_attachment");
                $format = explode(".", $report->investigation_result_attachment);
                $file = 'Lampiran Investigasi';
                $file .= '.';
                $file .= $format[1];
                $zip->addFile($path, $file);
                $zip->close();
            }
            Storage::delete('temporary_storage/temporary.pdf');
            return response()->download(public_path($fileName))->deleteFileAfterSend(true);
        }
    }
}
