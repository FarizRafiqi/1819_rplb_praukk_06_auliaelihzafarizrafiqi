<?php

namespace App\Http\Controllers;

use Jenssegers\Agent\Facades\Agent;

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
            return view('pages.pelanggan.index-mobile');
        }
        return view('pages.pelanggan.index');
    }

    /**
     * Untuk menampilkan halaman about us
     *
     */
    public function aboutUs()
    {
        return view('pages.pelanggan.about-us');
    }
}
