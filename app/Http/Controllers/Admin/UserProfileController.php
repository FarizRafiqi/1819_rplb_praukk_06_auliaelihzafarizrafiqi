<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserProfileRequest;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.profile.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $levels = Level::all();
        return view('pages.admin.profile.edit', compact('request', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UserProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserProfileRequest $request)
    {
        User::find(auth()->id())->update($request->except('password')+['password' => Hash::make($request->password)]);
        return redirect()->back()->withSuccess('Profil berhasil diperbarui!');
    }
}
