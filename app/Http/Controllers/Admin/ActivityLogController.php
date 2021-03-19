<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

/**
 * Resource Controller untuk Model ActivityLog
 */
class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies("activity_log_access"), Response::HTTP_FORBIDDEN, "Forbidden");
        if($request->ajax()){
            $activityLogs = ActivityLog::get();
            return DataTables::of($activityLogs)
                                ->editColumn('id_user', function($user){
                                    return '<a href='. route("admin.users.show", $user->id_user).' class="text-decoration-none">'.$user->id_user.'</a>';
                                })
                                ->rawColumns(['id_user'])
                                ->toJson();
        }
        return view("pages.admin.activity-log");
    }
}
