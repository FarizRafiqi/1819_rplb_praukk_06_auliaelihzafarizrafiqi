<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\PlnCustomer;
use App\Models\Usage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ElectricityUsageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $usage = Usage::all();
            return DataTables::of($usage)
                    ->addColumn('action', function($usage){
                        $button = '<a href='. route("admin.usage.edit", $usage->id).' class="btn btn-success btn-sm">edit</a>';
                        $button .= '<a href='. route("admin.usage.show", $usage->id).' class="btn btn-primary btn-sm mx-2">detail</a>';
                        $button .= '
                            <form action='.route("admin.usage.destroy", $usage->id).' method="POST" class="d-inline-block form-delete">
                                '. csrf_field() .'
                                '. method_field("DELETE") .'
                                <button type="submit" class="btn btn-danger btn-sm btn-delete">delete</button>
                            </form>
                        ';
                        return $button;
                    })
                    ->toJson();
        }
        return view('pages.admin.electricity-usage.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = PlnCustomer::get();
        return view('pages.admin.electricity-usage.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Usage::create($request->except('_token'));
        return redirect()->route('admin.usage.index')->withSuccess('Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usage  $usage
     * @return \Illuminate\Http\Response
     */
    public function show(Usage $usage)
    {
        return view('pages.admin.electricity-usage.show', compact('usage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usage  $usage
     * @return \Illuminate\Http\Response
     */
    public function edit(Usage $usage)
    {
        $customers = PlnCustomer::get();
        return view('pages.admin.electricity-usage.edit', compact('usage', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usage  $usage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usage $usage)
    {
        $usage->update($request->except(['_token', 'method']));
        return redirect()->route('admin.usage.index')->withSuccess('Data penggunaan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usage  $usage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usage $usage)
    {
        $bill = Bill::where('id_penggunaan', $usage->id)->first();
        $bill->usage()->dissociate();
        $bill->save();
        $usage->delete();
        return redirect()->route('admin.usage.index')->withSuccess('Data penggunaan berhasil dihapus!');
    }
}
