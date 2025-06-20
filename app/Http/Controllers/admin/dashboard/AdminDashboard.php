<?php

namespace App\Http\Controllers\admin\dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AdminDashboard extends Controller
{
    /**
     * Menampilkan halaman dashboard admin.
     */
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin untuk mengakses halaman ini.');
        }

        $pageConfigs = ['myLayout' => 'blank'];
        $users = User::all(); // Ambil semua data user

        return view('content.admin.dashboard.dashboard-admin', [
            'pageConfigs' => $pageConfigs,
            'users' => $users,
        ]);
    }
}