<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard.dashboard-admin');
        }

        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.auth.login', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * Menangani proses login.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $loginField = $request->input('email-username');
        $password = $request->input('password');

        $loginType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $loginField,
            'password' => $password,
        ];

        $remember = $request->has('remember-me');

        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed
            return redirect()->route('/charts/apex')->with('success', 'Login berhasil! Selamat datang kembali.');
        }
        // Authentication failed
        return back()->withErrors([
            'email-username' => 'Kredensial yang Anda masukkan tidak cocok dengan data kami.',
        ])->onlyInput('email-username'); // Mengembalikan input email-username saja

    }

    /**
     * Menangani proses logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}
