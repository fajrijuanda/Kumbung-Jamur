<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login
    public function viewLogin()
    {
        // return view();
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Generate ulang session
            $request->session()->regenerate();

            // Redirect ke halaman dashboard
            return redirect()->intended('home');
        }

        return back()->with('alert', [
            'type' => 'danger',
            'message' => 'Email atau password salah',
        ]);
    }

    // Forgot Password
    public function viewForgotPassword()
    {
        // return view();
    }

    public function sendResetLink(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        Auth::passwordResetLink($data['email']);

        // Kirim email reset password
        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Email reset password berhasil dikirim',
        ]);
    }

    // Reset Password
    public function viewResetPassword()
    {
        // return view();
    }

    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        /**
         * Mengupdate password
         * @var User
         */
        $user = Auth::user();
        $user->update($data);

        return redirect()->route('auth.login')->with('alert', [
            'type' => 'success',
            'message' => 'Password berhasil diubah',
        ]);
    }

    public function logout()
    {
        // Hapus session
        Auth::logout();
        // Redirect ke halaman login
        return redirect()->route('auth.login');
    }
}
