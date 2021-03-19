<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller untuk menangani login user
 */
class LoginController extends Controller
{
    /**
     * Method untuk menampilkan halaman login
     */
    public function index()
    {
        if(Auth::check()){
            return $this->checkUserLevel();
        }
        return view('auth.login');
    }

    /**
     * Method untuk mengautentikasi user
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials, $request->remember_me)){
            $request->session()->regenerate();
            ActivityLog::create([
                'id_user' => auth()->user()->id,
                'tabel_referensi' => '-',
                'id_referensi' => null,
                'deskripsi' => 'User login',
            ]);
            return $this->checkUserLevel();
        }
        
        return back()->withErrors([
            'email' => 'Email yang diberikan salah',
            'password' => 'Password yang diberikan salah'
        ]);
    }

    /**
     * Method untuk logout sesi login
     */
    public function logout(Request $request)
    {
        ActivityLog::create([
            'id_user' => auth()->user()->id,
            'tabel_referensi' => '-',
            'id_referensi' => null,
            'deskripsi' => 'User logout',
        ]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    /**
     * Method untuk mengecek level user apakah dia Admin, Bank, atau Pelanggan
     */
    private function checkUserLevel()
    {
        if(auth()->user()->isAdmin() || auth()->user()->isBank()){
            return redirect()->intended();
        }

        return redirect()->route('home');
    }
}
