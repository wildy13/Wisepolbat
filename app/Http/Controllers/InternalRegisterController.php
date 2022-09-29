<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InternalRegisterController extends Controller
{
    public function index()
    {
        return view('LandingPage.Register.internal');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|min:5|max:255',
            'nim_or_nid' => 'required|unique:users',
            'email' => 'required|email:dns|unique:users',
            'confirmPassword' => 'required|min:5|max:255',
            'password' => 'required|same:confirmPassword|min:5|max:255',
        ]);

        $validateData['email_verification_code'] = Str::random(40);
        $validateData['password'] = Hash::make($validateData['password']);
        $validateData['is_internal'] = TRUE;
        $registrasi = User::create($validateData);

        if ($registrasi) {

            Mail::to($request->email)->send(new EmailVerificationMail($registrasi));

            return redirect()->route('login')->with('success', '<span><center><b>Registrasi Telah Berhasil Dilakukan</b> <br> Silahkan Verifiksi Akun Melalui Alamat Email Anda</center></span>');
        } else {
            return redirect()->route('internalRegister')->with('failed', '<span><center><b>Registrasi Gagal Dilakukan</b></center></span>');
        }
    }
}
