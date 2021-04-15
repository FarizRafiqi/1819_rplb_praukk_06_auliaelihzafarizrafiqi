<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlnCustomerRequest;
use App\Http\Requests\Admin\MassDestroyPlnCustomerRequest;
use App\Models\PlnCustomer;
use App\Models\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class PLNCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies("pln_customer_access"), Response::HTTP_FORBIDDEN, "Forbidden");

        if($request->ajax()){   
            $customers = PlnCustomer::with("tariff", "usages")->get();
            return DataTables::of($customers)
                    ->addColumn("action", function($customers){
                        $button = '<a href='. route("admin.pln-customers.edit", $customers->id).' class="btn btn-success btn-sm">edit</a>';
                        $button .= '<a href='. route("admin.pln-customers.show", $customers->id).' class="btn btn-primary btn-sm mx-2">detail</a>';
                        $button .= '
                            <form action='.route("admin.pln-customers.destroy", $customers->id).' method="POST" class="d-inline-block form-delete">
                                '. csrf_field() .'
                                '. method_field("DELETE") .'
                                <button type="submit" class="btn btn-danger btn-sm btn-delete">delete</button>
                            </form>
                        ';
                        return $button;
                    })
                    ->toJson();
        }
        return view("pages.admin.pln-customer.index");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies("pln_customer_create"), Response::HTTP_FORBIDDEN, "Forbidden");
        $tariffs = Tariff::get();
        return view("pages.admin.pln-customer.create", compact("tariffs"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\PlnCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlnCustomerRequest $request)
    {
        PlnCustomer::create($request->all());
        return redirect()->route("admin.pln-customers.index")->withSuccess("Data berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlnCustomer  $plnCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(PlnCustomer $plnCustomer)
    {
        abort_if(Gate::denies("pln_customer_show"), Response::HTTP_FORBIDDEN, "Forbidden");
        return view("pages.admin.pln-customer.show", compact("plnCustomer"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\PlnCustomer  $plnCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(PlnCustomer $plnCustomer)
    {
        abort_if(Gate::denies("pln_customer_edit"), Response::HTTP_FORBIDDEN, "Forbidden");
        $tariffs = Tariff::get();
        return view("pages.admin.pln-customer.edit", compact("plnCustomer", "tariffs"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\PlnCustomerRequest  $request
     * @param  \App\Models\PlnCustomer  $plnCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlnCustomer $plnCustomer)
    {
        abort_if(Gate::denies("pln_customer_update"), Response::HTTP_FORBIDDEN, "Forbidden");
        $plnCustomer->update($request->all());
        return redirect()->route('admin.pln-customers.index')->withSuccess("Data Pelanggan Berhasil Diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlnCustomer  $plnCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlnCustomer $plnCustomer)
    {
        abort_if(Gate::denies("pln_customer_delete"), Response::HTTP_FORBIDDEN, "Forbidden");
        if($plnCustomer->usages()->count() > 0){
            alert()->error("Pelanggan tidak bisa dihapus, karena mempunyai relasi dengan data penggunaan");
            return back();
        }
        
        $plnCustomer->delete();
        return back()->withSuccess("Pelanggan Berhasil Dihapus!");
    }

    public function massDestroy(MassDestroyPlnCustomerRequest $request)
    {
        abort_if(Gate::denies("pln_customer_delete"), Response::HTTP_FORBIDDEN, "Forbidden");
        $customers = PlnCustomer::whereIn('id', request('ids'))->get();
        foreach($customers as $customer){
            if($customer->usages()->count() > 0){
                alert()->error("Pelanggan tidak bisa dihapus, karena mempunyai relasi dengan data penggunaan");
                return back();
            }
            $customer->delete();
        }

        return redirect()->route('admin.pln-customers.index')->withSuccess('Data PLN customer(s) berhasil dihapus!');
    }
}
