<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        if(Auth::user()->isAdmin() || Auth::user()->isBank()){
            return redirect()->intended('admin.dashboard');
        }

        return redirect()->route('home');
    }
}
