<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TariffRequest;
use App\Models\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

/**
 * Resource controller untuk model Tariff
 */
class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!Gate::allows('tariff_access')){
            abort(403);
        }

        if($request->ajax()){
            $tariffs = Tariff::with('plnCustomers')->get();
            return DataTables::of($tariffs)
                    ->addColumn('action', function($tariffs){
                        $button = '<a href='. route("admin.tariffs.edit", $tariffs->id).' class="btn btn-success btn-sm mr-2">edit</a>';
                        $button .= '
                            <form action='.route("admin.tariffs.destroy", $tariffs->id).' method="POST" class="d-inline-block form-delete">
                                '. csrf_field() .'
                                '. method_field("DELETE") .'
                                <button type="submit" class="btn btn-danger btn-sm btn-delete">delete</button>
                            </form>
                        ';
                        return $button;
                    })
                    ->toJson();
        }
        return view('pages.admin.tariff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('tariff_create')){
            abort(403);
        }
        return view('pages.admin.tariff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TariffRequest $request)
    {
        Tariff::create($request->all());
        return redirect()->route('admin.tariffs.index')->withSuccess('Tarif berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function show(Tariff $tariff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function edit(Tariff $tariff)
    {
        if(!Gate::allows('tariff_edit')){
            abort(403);
        }
        return view('pages.admin.tariff.edit', compact('tariff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TariffRequest  $request
     * @param  \App\Models\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function update(TariffRequest $request, Tariff $tariff)
    {
        if(!Gate::allows('tariff_update')){
            abort(403);
        }
        $tariff->update($request->validated());
        return redirect()->route('admin.tariffs.index')->withSuccess('Tarif berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tariff $tariff)
    {
        if(!Gate::allows('tariff_delete')){
            abort(403);
        }
        if($tariff->plnCustomers()->count() > 0){
            alert()->error('Tarif tidak bisa dihapus, karena mempunyai relasi dengan data pelanggan');
            return back();
        }
        $tariff->delete();
        return redirect()->route('admin.tariffs.index')->withSuccess('Tarif berhasil dihapus!');
    }
}
