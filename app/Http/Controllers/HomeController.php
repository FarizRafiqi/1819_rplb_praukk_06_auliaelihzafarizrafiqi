<?php

namespace App\Http\Controllers;

use App\Models\Usage;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Untuk menampilkan halaman riwayat transaksi pelanggan.
     * @return \Illuminate\Http\Response
     */
    public function transactionHistory(Request $request)
    {
        $userPayments = $request->user()->payments()->get();
        return view('pages.pelanggan.riwayat-transaksi', compact('userPayments'));
    }

    /**
     * Untuk mengecek tagihan pelanggan
     */
    public function checkBill(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'id_pelanggan' => 'required|numeric|exists:pln_customers,id'
            ],
            [
                'id_pelanggan.required' => 'ID Pelanggan tidak boleh kosong',
                'id_pelanggan.numeric' => 'ID Pelanggan harus berupa angka',
                'id_pelanggan.exists' => 'ID Pelanggan tidak terdaftar',
            ]
        );

        if($validator->fails()){
            return back()->with("errors", $validator->errors())->withInput();
        }
       
        $userBill = Usage::where('id_pelanggan_pln', $request->id_pelanggan)
                            ->where('bulan', now()->locale('id')->monthName)
                            ->where('tahun', now()->year)->get();
        dd($userBill);
        // if($userBill){
        //     return view('pages.pelanggan.index', compact('userBill'));
        // }

        return view('pages.pelanggan.index');
        
    }
}
