<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Level;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!Gate::allows('user_access')){
            abort(403);
        }
        if($request->ajax()){
            $users = User::with('level')->get();
            return DataTables::of($users)
                    ->addColumn('action', function($users){
                        $button = '<a href='. route("admin.users.edit", $users->id).' class="btn btn-success btn-sm">edit</a>';
                        $button .= '<a href='. route("admin.users.show", $users->id).' class="btn btn-primary btn-sm mx-2">detail</a>';
                        $button .= '<a href='. route("admin.users.destroy", $users->id).' class="btn btn-danger btn-sm">delete</a>';
                        return $button;
                    })
                    ->toJson();
        }
        return view('pages.admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('user_create')){
            abort(403);
        }
        $levels = Level::get();
        return view('pages.admin.user.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request['password'] = bcrypt($request->password);
        User::create($request->all());
        return redirect()->route('admin.users.index')->withSuccess('Data user berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(!Gate::allows('user_show')){
            abort(403);
        }
        return view('pages.admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(!Gate::allows('user_edit')){
            abort(403);
        }
        $levels = Level::get();
        return view('pages.admin.user.edit', compact('user', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if(!Gate::allows('user_update')){
            abort(403);
        }
        $user->update($request->all());
        return redirect()->route('admin.users.index')->withSuccess('Data ' . $user->nama . 'berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(!Gate::allows('user_delete')){
            abort(403);
        }
        $user->delete();
        return redirect()->route('admin.users.index')->withSuccess('Data ' . $user->nama . 'berhasil dihapus!');
    }
}
