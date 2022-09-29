<?php

use App\Http\Controllers\DashboardDaftarAduanUserController;
use App\Http\Controllers\DashboardPetugasController;
use App\Http\Controllers\DashboardDaftarPenggunaController;
use App\Http\Controllers\DashboardPesanBantuanController;
use App\Http\Controllers\DashboardProfilPelaporController;
use App\Http\Controllers\ExternalRegisterController;
use App\Http\Controllers\InternalRegisterController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\DashboardReportController;
use App\Http\Controllers\DashboardResetPasswordController;
use App\Http\Controllers\DashboardTanggapanController;
use App\Http\Controllers\DashboardUbahPasswordController;
use App\Http\Controllers\DashboardUbahProfilController;
use App\Http\Controllers\DashboardUbahProfilPelaporController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ZipController;
use App\Mail\EmailVerificationMail;
use App\Models\Notification;
use App\Models\Report;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('LandingPage.index');
});
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authentication'])->middleware('guest')->name('login');
Route::get('/externalregister', [ExternalRegisterController::class, 'index'])->name('externalRegister');
Route::post('/externalregister', [ExternalRegisterController::class, 'store'])->name('externalRegister');
Route::get('/internalregister', [InternalRegisterController::class, 'index'])->name('internalRegister');
Route::post('/internalregister', [InternalRegisterController::class, 'store'])->name('internalRegister');
Route::get('/auth/verify-email/{verification_code}', [EmailVerificationController::class, 'verify_email'])->middleware('guest')->name('verify_email');
Route::post('/pesanbantuan', [DashboardPesanBantuanController::class, 'store']);
Route::get('/password/forgot', [ForgotPasswordController::class, 'showForgotForm'])->name('forgotPassword');
Route::post('/password/forgot', [ForgotPasswordController::class, 'sendResetLink'])->name('forgotPasswordLink');
Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('resetPasswordForm');
Route::post('/password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('resetPassword');

Route::group(['middleware' => ['auth:pelapor']], function () {
    route::get('/dashboard/faq', function () {
        return view('Dashboard.faq');
    })->name('faq');
});

Route::group(['middleware' => ['auth:petugas']], function () {
    route::resource('/dashboard/pesanbantuan', DashboardPesanBantuanController::class);
    route::resource('/dashboard/petugas', DashboardPetugasController::class);
});

Route::group(['middleware' => ['auth:petugas,pelapor']], function () {
    route::get('/dashboard', function () {
        return redirect('/dashboard/report');
    })->name('dashboard');
    route::resource('/dashboard/report', DashboardReportController::class);
    route::resource('/dashboard/tanggapan', DashboardTanggapanController::class);
    route::get('/dashboard/notifications', function () {
        if (count(Auth::user()->unreadNotifications) != 0) {
            Auth::user()->unreadNotifications->markAsRead();
        }
        return view('Dashboard.halamanNotifikasi');
    });
    route::get('/notification/delete/{notification}', function (Notification $notification) {
        Notification::destroy($notification->id);
        return back();
    });
    route::get('/dashboard/profil', [DashboardUbahProfilController::class, 'index']);
    route::post('/dashboard/profil', [DashboardUbahProfilController::class, 'update']);
    route::get('/dashboard/password', [DashboardUbahPasswordController::class, 'index']);
    route::post('/dashboard/password', [DashboardUbahPasswordController::class, 'update']);
    // route::get('/report/topdf/{report}', function (Report $report) {
    //     $pihakTerkait = explode(';', $report->suspect);
    //     $jumlahPihakTerkait = (count($pihakTerkait));
    //     unset($pihakTerkait[$jumlahPihakTerkait - 1]);
    //     $suspect = [];
    //     foreach ($pihakTerkait as $pt) {
    //         $pt = explode(',', $pt);
    //         $suspect[] = $pt;
    //     }
    //     $report->suspect = $suspect;
    //     $created_at = explode(' ', $report->created_at);
    //     $pdf = PDF::loadview('Dashboard.pdfReport', [
    //         'report' => $report,
    //         'created_at' => $created_at[0]
    //     ])->setpaper('A4', 'landscape');
    //     return $pdf->stream($report->title . '.pdf');
    // })->name('topdf');
    route::get('/download/{report:id}', function (Report $report) {
        if (Storage::disk('local')->exists("public/$report->file_uploaded")) {
            $path = Storage::disk('local')->path("public/$report->file_uploaded");
            $format = explode(".", $report->file_uploaded);
            $file = $report->title;
            $file .= '.';
            $file .= $format[1];
            return Response::download($path, $file);
        };
    })->name('downloadFile');
    route::post('/zip/{report:id}', [ZipController::class, 'zipFile'])->name('zipFileDownload');
    route::post('/logout', function (Request $request) {
        if (Auth::guard('petugas')->check()) {
            Auth::guard('petugas')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        } elseif (Auth::guard('pelapor')->check()) {
            Auth::guard('pelapor')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect('/');
    })->name('logout');
});
