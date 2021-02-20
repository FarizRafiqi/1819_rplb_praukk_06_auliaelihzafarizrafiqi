<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Agent;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Untuk menampilkan halaman home
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Agent::isMobile()){
            return view('pages.index-mobile');
        }
        return view('pages.index');
    }

    /**
     * Untuk menampilkan halaman about us
     *
     */
    public function aboutUs()
    {
        return view('pages.about-us');
    }

    /**
     * Untuk menampilkan halaman riwayat transaksi pelanggan.
     * @return \Illuminate\Http\Response
     */
    public function riwayatTransaksi(Request $request)
    {
        $userPayments = $request->user()->payments()->get();
        return view('pages.riwayat-transaksi', compact('userPayments'));
    }
}
