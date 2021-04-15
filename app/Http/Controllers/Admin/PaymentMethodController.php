<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies("payment_method_access"), Response::HTTP_FORBIDDEN, "Forbidden");

        if($request->ajax()){
            $paymentMethods = PaymentMethod::all();
            return DataTables::of($paymentMethods)
                                ->addColumn("action", function($row){
                                    $showGate       = 'payment_method_show';
                                    $editGate       = 'payment_method_edit';
                                    $deleteGate     = 'payment_method_delete';
                                    $crudRoutePart  = 'payment-methods';
                                    
                                    return view('partials.datatables-action', compact(
                                        'showGate', 
                                        'editGate', 
                                        'deleteGate',
                                        'crudRoutePart',
                                        'row',
                                    ));
                                })
                                ->editColumn('gambar', function($row){
                                    return "<img src='" . Storage::url($row->gambar) . "' width='100px'>";
                                })
                                ->rawColumns(['gambar', 'action'])
                                ->toJson();
        }
        return view("pages.admin.payment-method.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies("payment_method_create"), Response::HTTP_FORBIDDEN, "Forbidden");
        return view("pages.admin.payment-method.create");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        abort_if(Gate::denies("payment_method_show"), Response::HTTP_FORBIDDEN, "Forbidden");
        return view('pages.admin.payment-method.show', compact('paymentMethod'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        abort_if(Gate::denies("payment_method_edit"), Response::HTTP_FORBIDDEN, "Forbidden");
        return view("pages.admin.payment-method.edit", compact("paymentMethod"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        abort_if(Gate::denies("payment_method_update"), Response::HTTP_FORBIDDEN, "Forbidden");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        abort_if(Gate::denies("payment_method_delete"), Response::HTTP_FORBIDDEN, "Forbidden");
        if($paymentMethod->payments()->count() > 0){
            alert()->error("Data tidak bisa dihapus karena mempunyai relasi dengan pembayaran.");
            return redirect()->back();
        }
        $paymentMethod->delete();
        return redirect()->route('admin.payment-methods.index')->withSuccess("Data berhasil dihapus!");
    }
}
