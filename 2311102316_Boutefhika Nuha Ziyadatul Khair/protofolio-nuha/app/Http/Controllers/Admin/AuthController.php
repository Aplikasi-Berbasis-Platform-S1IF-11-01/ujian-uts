<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $storedUsername = SiteSetting::get('admin_username', 'admin');
        $storedPassword = SiteSetting::get('admin_password');

        $validUsername = $request->username === $storedUsername;
        $validPassword = Hash::check($request->password, $storedPassword);

        if ($validUsername && $validPassword) {
            session(['admin_logged_in' => true, 'admin_username' => $storedUsername]);
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali! 👋');
        }

        return back()->withErrors(['login' => 'Username atau password salah.'])->withInput();
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_username']);
        return redirect()->route('admin.login')->with('success', 'Berhasil logout.');
    }
}
