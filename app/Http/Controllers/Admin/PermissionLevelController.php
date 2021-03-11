<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermissionLevel;
use Illuminate\Http\Request;

class PermissionLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.permission-level.index');
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
     * @param  \App\Models\PermissionLevel  $permissionLevel
     * @return \Illuminate\Http\Response
     */
    public function show(PermissionLevel $permissionLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PermissionLevel  $permissionLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(PermissionLevel $permissionLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PermissionLevel  $permissionLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermissionLevel $permissionLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PermissionLevel  $permissionLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermissionLevel $permissionLevel)
    {
        //
    }
}
