<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\ForgotPassword;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use ReflectionFunctionAbstract;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('LandingPage.ForgotPassword.index');
    }

    public function sendResetLink(Request $request)
    {
        if ($request->level === 'petugas') {
            $request->validate([
                'email' => 'required|email|exists:petugas,email'
            ]);
        } else {
            $request->validate([
                'email' => 'required|email|exists:users,email'
            ]);
        }


        $token = Str::random(50);
        $action_link = route('resetPasswordForm', [
            'token' => $token,
            'email' => $request->email
        ]);

        ForgotPassword::create([
            'email' => $request->email,
            'token' => $token
        ]);

        Mail::to($request->email)->send(new ForgotPasswordMail($action_link));

        return back()->with('success', 'we have e-mailed your password reset link');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('LandingPage.ForgotPassword.formResetPassword', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {

        if (Petugas::where('email', $request->email)->first()) {
            $request->validate([
                'email' => 'required|email|exists:petugas,email',
                'passwordBaru' => 'required|min:5',
                'konfirmasiPasswordBaru' => 'required|same:passwordBaru'
            ]);
        } else {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'passwordBaru' => 'required|min:5',
                'konfirmasiPasswordBaru' => 'required|same:passwordBaru'
            ]);
        }

        $check_token = ForgotPassword::where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if (!$check_token) {
            return back()->withInput()->with('failed', 'Invalid Token');
        } else {

            if (Petugas::where('email', $request->email)->first()) {
                Petugas::where('email', $request->email)->update([
                    'password' => Hash::make($request->passwordBaru)
                ]);
            } else {
                User::where('email', $request->email)->update([
                    'password' => Hash::make($request->passwordBaru)
                ]);
            }
            ForgotPassword::where('email', $request->email)->delete();
            return redirect()->route('login')->with('success', 'Reset Password Berhasil dilakukan');
        }
    }
}
