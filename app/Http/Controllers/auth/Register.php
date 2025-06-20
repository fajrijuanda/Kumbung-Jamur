<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    //
    public function index()
    {
        // Jika user sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard.dashboard-admin');
        }

        $pageConfigs = ['myLayout' => 'blank'];
        // Pastikan nama view sesuai dengan lokasi file Anda
        return view('content.auth.register', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * Menangani proses registrasi user baru.
     *
     * @param  \App\Http\Requests\Auth\RegisterRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request)
    {
        // 2. Validasi otomatis menggunakan RegisterRequest

        // 3. Buat user baru
        $user = User::create([
            'username' => $request->username,
            // 'name' juga bisa diisi sama dengan username jika ada kolomnya
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 4. Login user yang baru dibuat secara otomatis
        Auth::login($user);

        // 5. Redirect ke dashboard dengan pesan sukses
        return redirect()->route('admin.dashboard.dashboard-admin')->with('success', 'Akun berhasil dibuat. Selamat datang!');
    }
}
