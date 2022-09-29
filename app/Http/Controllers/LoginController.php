<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;
use App\Models\Management;
use App\Models\InvestigationTeam;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('LandingPage.Login.index');
    }

    public function authentication(Request $request)
    {
        $request->validate([
            'usernameEmailNimNid' => 'required',
            'password' => 'required',
            'grecaptcha' => 'required'
        ]);

        $grecaptcha = $request->grecaptcha;
        $client = new Client();
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' =>
                [
                    'secret' => env('GOOGLE_CAPTCHA_SECRET'),
                    'response' => $grecaptcha
                ]
            ]
        );
        $body = json_decode((string)$response->getBody());

        if ($body) {

            // $credentials = Hash::check($request->password, User::where('id', $request->usernameEmailNimNid)->first());
            if ($pelapor = User::where('nim_or_nid', $request->usernameEmailNimNid)->first()) {
                if (!$pelapor->email_verified_at) {
                    return back()->with('failed', ' <center><b>Akun anda belum diverifikasi</b><br>Silahkan verifikai melalui email anda</center>');
                } else {
                    if (Auth::guard('pelapor')->attempt(['nim_or_nid' => $request->usernameEmailNimNid, 'password' => $request->password])) {
                        return redirect()->route('dashboard');
                    } else {
                        return back()->with('failed', ' <center><b>Password Salah</b></center>');
                    }
                }
            }

            if ($pelapor = User::where('email', $request->usernameEmailNimNid)->first()) {
                if (!$pelapor->email_verified_at) {
                    return back()->with('failed', ' <center><b>Akun anda belum diverifikasi</b><br>Silahkan verifikai melalui email anda</center>');
                } else {

                    if (Auth::guard('pelapor')->attempt(['email' => $request->usernameEmailNimNid, 'password' => $request->password])) {
                        $request->session()->regenerate();
                        return redirect()->route('dashboard');
                    } else {
                        return back()->with('failed', ' <center><b>Password Salah</b></center>');
                    }
                }
            }

            if (Petugas::where('username', $request->usernameEmailNimNid)->first()) {
                if (Auth::guard('petugas')->attempt(['username' => $request->usernameEmailNimNid, 'password' => $request->password])) {
                    $request->session()->regenerate();
                    return redirect()->route('dashboard');
                } else {
                    return back()->with('failed', ' <center><b>Password Salah</b></center>');
                }
            }
        } else {
            return back()->with('failed', '<b><center>Kode Captcha Tidak Valid</center></b>');
        }

        return back()->with('failed', ' <b><center>Login Gagal</center></b>');
    }
}
