<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Controller
{
    //
    /**
     * Menampilkan halaman lupa password.
     */
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.auth.forgot-password', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * Menangani proses pengiriman email reset password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        // Logika untuk mengirim email reset password
        // Misalnya, menggunakan Laravel's Password Broker
        $status = Password::sendResetLink($request->only('email'));

        // 3. Memberikan feedback berdasarkan status pengiriman
        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        // Jika email tidak ditemukan, akan kembali dengan error
        return back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }

    /**
     * Menampilkan form untuk mereset password.
     * Dipanggil oleh route: GET /reset-password/{token}
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('content.auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Menangani proses reset password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        // 1. Validasi semua input
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // 2. Mencoba mereset password menggunakan fitur bawaan Laravel
        $status = Password::reset($request->all(), function (User $user, string $password) {
            // Callback ini akan dijalankan jika token dan email valid
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();
        });

        // 3. Memberikan feedback dan redirect
        if ($status == Password::PASSWORD_RESET) {
            // Redirect ke halaman login dengan pesan sukses
            return redirect()->route('login')->with('status', __($status));
        }

        // Jika token tidak valid atau error lain
        return back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
}
