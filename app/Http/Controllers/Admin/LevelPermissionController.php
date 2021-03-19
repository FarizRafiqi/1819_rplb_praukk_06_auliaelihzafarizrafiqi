<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LevelPermission;
use Illuminate\Http\Request;

class LevelPermissionController extends Controller
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
     * @param  \App\Models\LevelPermission  $permissionLevel
     * @return \Illuminate\Http\Response
     */
    public function show(LevelPermission $permissionLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LevelPermission  $permissionLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(LevelPermission $permissionLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LevelPermission  $permissionLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LevelPermission $permissionLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LevelPermission  $permissionLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(LevelPermission $permissionLevel)
    {
        //
    }
}
