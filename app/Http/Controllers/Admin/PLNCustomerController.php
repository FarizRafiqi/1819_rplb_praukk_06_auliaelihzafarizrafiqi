<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlnCustomer;
use App\Models\Tariff;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PLNCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){   
            $customers = PlnCustomer::with('tariff')->get();
            return DataTables::of($customers)
                    ->addColumn('action', function($customers){
                        $button = '<a href='. route("admin.pln-customers.edit", $customers->id).' class="btn btn-success btn-sm">edit</a>';
                        $button .= '<a href='. route("admin.pln-customers.show", $customers->id).' class="btn btn-primary btn-sm mx-2">detail</a>';
                        $button .= '<a href='. route("admin.pln-customers.destroy", $customers->id).' class="btn btn-danger btn-sm">delete</a>';
                        return $button;
                    })
                    ->toJson();
        }

        return view('pages.admin.pln-customer.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tariffs = Tariff::get();
        return view('pages.admin.pln-customer.create', compact('tariffs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PlnCustomer::create($request->all());
        return redirect()->route('pages.admin.pln-customer.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlnCustomer  $plnCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(PlnCustomer $plnCustomer)
    {
        return view('pages.admin.pln-customer.show', compact('plnCustomer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\PlnCustomer  $plnCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(PlnCustomer $plnCustomer)
    {
        $tariffs = Tariff::get();
        return view('pages.admin.pln-customer.edit', compact('plnCustomer', 'tariffs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlnCustomer  $plnCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlnCustomer $plnCustomer)
    {
        $plnCustomer->update($request->all());
        return back()->with("success", "Pelanggan Berhasil Diubah!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlnCustomer  $plnCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlnCustomer $plnCustomer)
    {
        $plnCustomer->delete();

        return back()->with("Pelanggan Berhasil Dihapus!");
    }
}
