<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internal;
use App\Models\External;
use App\Models\User;


class EmailVerificationController extends Controller
{
    public function verify_email($verification_code)
    {

        if ($internal = User::where('email_verification_code', $verification_code)->first()) {
            if ($internal->email_verified_at) {
                return redirect()->route('login')->with('success', ' <center><b>Email Telah Diverifikasi</b></center>');
            } else {
                $internal->update([
                    'email_verified_at' => \Carbon\Carbon::now()
                ]);

                return redirect()->route('login')->with('success', '<center><b>Selamat Email Berhasil Diverifikasi</b></center>');
            }
        }

        if ($external = User::where('email_verification_code', $verification_code)->first()) {
            if ($external->email_verified_at) {
                return redirect()->route('login')->with('success', ' <center><b>Email Telah Diverifikasi</b></center>');
            } else {
                $external->update([
                    'email_verified_at' => \Carbon\Carbon::now()
                ]);

                return redirect()->route('login')->with('success', '<center><b>Selamat Email Berhasil Diverifikasi</b></center>');
            }
        }

        return redirect()->route('login')->with('failed', '<center><b>Alamat URL Tidak Valid</b></center>');
    }
}
