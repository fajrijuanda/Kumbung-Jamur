<?php
namespace App\Http\Controllers\user\dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserDashboard extends Controller
{
    /**
     * Menampilkan halaman dashboard user.
     */
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'user') {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai user untuk mengakses halaman ini.');
        }

        $pageConfigs = ['myLayout' => 'blank'];
        $users = User::all(); // Ambil semua data user

        return view('content.user.dashboard.dashboard-user', [
            'pageConfigs' => $pageConfigs,
            'users' => $users,
        ]);
    }
}