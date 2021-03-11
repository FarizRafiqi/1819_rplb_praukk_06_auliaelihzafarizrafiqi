<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

/**
 * Resource Controller untuk model Payment
 */
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!Gate::allows('payment_access')){
            abort(403);
        }

        if($request->ajax()){
            $payments = Payment::with(['plnCustomer', 'customer', 'details', 'paymentMethod'])->get();
            return Datatables::of($payments)
                    ->addColumn('action', function($payments){
                        $button = '<a href="'. route("admin.payments.edit", $payments->id).'" class="btn btn-success btn-sm">edit</a>';

                        $button .= '<a href="'. route("admin.payments.show", $payments->id).'" class="btn btn-primary btn-sm mx-2">detail</a>';
                        return $button;
                    })
                    ->toJson();
        }
        return view('pages.admin.payment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        if(!Gate::allows('payment_show')){
            abort(403);
        }
        if(request()->ajax()){
            return Datatables::of($payment->details())
                                ->toJson();
        }
        $totalBayar = $payment->total_bayar+$payment->denda+$payment->biaya_admin;
        $totalBayar = number_format($totalBayar, 2, ",", ".");
        return view('pages.admin.payment.show', compact('payment', 'totalBayar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        if(!Gate::allows('payment_edit')){
            abort(403);
        }

        return view('pages.admin.payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        if(!Gate::allows('payment_update')){
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:success,failed,pending'
        ]);
        $payment->update($request->only('status'));
        return redirect()->route('admin.payments.index')->with('success', 'Data pembayaran berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        
    }
}
