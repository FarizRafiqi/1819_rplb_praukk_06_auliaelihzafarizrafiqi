<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Usage;
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
                        $button .= '<a href='. route("admin.usage.destroy", $usage->id).' class="btn btn-danger btn-sm">delete</a>';
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
        return view('pages.admin.electricity-usage.create');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
