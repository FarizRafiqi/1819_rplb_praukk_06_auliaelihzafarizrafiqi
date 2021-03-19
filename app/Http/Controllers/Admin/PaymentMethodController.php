<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $paymentMethods = PaymentMethod::all();
            return DataTables::of($paymentMethods)
                                ->addColumn("action", function($paymentMethod){
                                    $buttons = '<a href='. route("admin.payment-methods.edit", $paymentMethod->id) .' class="btn btn-sm btn-success btn-edit">edit</a>';
                                    $buttons .= '<a href='. route("admin.payment-methods.show", $paymentMethod->id) .' class="btn btn-sm mx-2 btn-primary btn-detail">detail</a>';
                                    $buttons .= '
                                        <form action=' . route("admin.payment-methods.destroy", $paymentMethod->id). ' method="POST" class="d-inline-block form-delete">
                                            '.csrf_field().'
                                            '. method_field("DELETE") .'
                                            <button class="btn btn-sm btn-danger btn-delete" type="submit">delete</button>
                                        </form>
                                    ';
                                    return $buttons;
                                })
                                ->editColumn('gambar', function($paymentMethod){
                                    return "<img src='" . Storage::url($paymentMethod->gambar) . "' width='100px'>";
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
        return view("pages.admin.payment-method.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
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
        if($request->gambar){
            $temporaryFile = TemporaryFile::where("folder", $request->gambar)->firstOrFail();
            $from = "tmp/".$request->gambar."/".$temporaryFile->filename;
            $to = "public/img/payment-method/" . $temporaryFile->filename;
            if(!Storage::exists($to)){
                Storage::move($from, $to);
                $paymentMethod->update($request->except('gambar')+["gambar" => $temporaryFile->filename]);
                rmdir(storage_path('app/tmp/'.$request->gambar));
            }
            
            return redirect()->route("admin.payment-methods.index")->with("success", "Metode Pembayaran berhasil ditambahkan!");
        }
        $paymentMethod->update($request->except('gambar'));
        return redirect()->route('admin.payment-methods.index')->with("success", "Data berhasil diubah!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        if($paymentMethod->payments()->count() > 0){
            return redirect()->back()->with("error", "Data tidak bisa dihapus karena mempunyai relasi dengan pembayaran.");
        }
        $paymentMethod->delete();
        return redirect()->route('admin.payment-methods.index')->with("success", "Data berhasil dihapus!");
    }
}
