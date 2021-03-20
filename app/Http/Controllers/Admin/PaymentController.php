<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

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
        abort_if(Gate::denies("payment_access"), Response::HTTP_FORBIDDEN, "Forbidden");

        if($request->ajax()){
            $payments = Payment::with(["plnCustomer", "customer", "details", "paymentMethod"])->get();
            return Datatables::of($payments)
                    ->addColumn("action", function($payments){
                        $button = '<a href="'. route("admin.payments.edit", $payments->id).'" class="btn btn-success btn-sm">edit</a>';

                        $button .= '<a href="'. route("admin.payments.show", $payments->id).'" class="btn btn-primary btn-sm mx-2">detail</a>';
                        return $button;
                    })
                    ->toJson();
        }
        return view("pages.admin.payment.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        abort_if(Gate::denies("payment_show"), Response::HTTP_FORBIDDEN, "Forbidden");
        if(request()->ajax()){
            return Datatables::of($payment->details())
                                ->toJson();
        }

        $totalBayar = $payment->total_bayar+$payment->denda+$payment->biaya_admin;
        $totalBayar = number_format($totalBayar, 2, ",", ".");
        return view("pages.admin.payment.show", compact("payment", "totalBayar"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        abort_if(Gate::denies("payment_edit"), Response::HTTP_FORBIDDEN, "Forbidden");

        return view("pages.admin.payment.edit", compact("payment"));
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
        abort_if(Gate::denies("payment_update"), Response::HTTP_FORBIDDEN, "Forbidden");

        $request->validate([
            'status' => ['required', Rule::in(config('enum.payment_status'))],
        ]);
        
        if(auth()->user()->isBank()){
            $payment->update([
                'id_bank' => auth()->id(),
                'status' => $request->status,
            ]);
        }else{
            $payment->update($request->only("status"));
        }
        return redirect()->route("admin.payments.index")->withSuccess("Data pembayaran berhasil diubah!");
    }
}
