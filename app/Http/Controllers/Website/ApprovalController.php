<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\Barang;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleMiddleware;

class ApprovalController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:spv_app,mgr_app')->only('show_approval');
        // $this->middleware('permission:spv_app,mgr_app')->only('show_approval_ajax');
    }
    public function show_approval(Request $request)
    {
        $link = $request->query('link');
        if (!in_array($link, ['spv', 'mgr', 'itd', 'ga'])) {
            abort(401);
        }
        if (Auth::user()->hasPermissionTo('spv_app') && $link == 'spv') {
            return view('website.pages.izin.approval');
        } elseif (Auth::user()->hasPermissionTo('mgr_app') && $link == 'mgr') {
            return view('website.pages.izin.approval');
        } elseif (Auth::user()->hasPermissionTo('itd_app') && $link == 'itd') {
            return view('website.pages.izin.approval');
        } elseif (Auth::user()->hasPermissionTo('ga_app') && $link == 'ga') {
            return view('website.pages.izin.approval');
        } else {
            abort(401);
        }
    }

    public function ajax_show_approval(Request $request)
    {

        // return $request->link;
        $link = $request->link;
        // if (!in_array($link, ['spv', 'mgr', 'itd', 'ga'])) {
        //     $data = []; // An empty array or null if no records exist
        //     return DataTables::of($data)->make(true);
        // }
        $data = Izin::select('izin.id', 'reg_no', DB::Raw('users.name as creator_name'), 'izin.created_at', 'status')
            ->join('users', 'izin.created_by', 'users.id')
            ->where('izin.created_dept', Auth::user()->department->id);

        if (Auth::user()->hasPermissionTo('spv_app') && $link == 'spv') {
            $data = $data->where('status', 'Created');
        } elseif (Auth::user()->hasPermissionTo('mgr_app') && $link == 'mgr') {
            $data = $data->where('status', 'SPV Approved');
        } elseif (Auth::user()->hasPermissionTo('itd_app') && $link == 'itd') {
            $data = $data->where('status', 'GA Approved');
        } elseif (Auth::user()->hasPermissionTo('ga_app') && $link == 'ga') {
            $data = $data->where('status', 'MGR Approved');
        } else {
            $data = []; // An empty array or null if no records exist
            return DataTables::of($data)->make(true);
        }
        $data = $data->orderBy('izin.id', 'desc')->with('barang');
        return DataTables::of($data)->make(true);
    }

    public function approve_ajax(Request $request)
    {
        $data = Izin::where('reg_no', $request->reg_no);
        $link = $request->link;
        try {
            if (Auth::user()->hasPermissionTo('spv_app') && $link == 'spv') {
                $data = $data->where('created_dept', Auth::user()->department->id)
                    ->where('status', 'Created')->first();
                if ($data) {
                    $data->status = 'SPV Approved';
                    $data->spv_app_by = Auth::user()->id;
                    $data->app_spv_date = Carbon::now();
                    $data->save();
                    return "Sukses Approve";
                } else {
                    throw new Exception("Not Found!");
                }
            } elseif (Auth::user()->hasPermissionTo('mgr_app') && $link == 'mgr') {

                $data = $data->where('created_dept', Auth::user()->department->id)
                    ->where('status', 'SPV Approved')->first();
                if ($data) {
                    $data->status = 'MGR Approved';
                    $data->spv_app_by = Auth::user()->id;
                    $data->app_spv_date = Carbon::now();
                    $data->save();
                    return "Sukses Approve";
                } else {
                    throw new Exception("Not Found!");
                }
            } elseif (Auth::user()->hasPermissionTo('ga_app') && $link == 'ga') {

                $data = $data->where('status', 'MGR Approved')->first();
                if ($data) {
                    $data->status = 'GA Approved';
                    $data->spv_app_by = Auth::user()->id;
                    $data->app_spv_date = Carbon::now();
                    $data->save();
                    return "Sukses Approve";
                } else {
                    throw new Exception("Not Found!");
                }
            } elseif (Auth::user()->hasPermissionTo('itd_app') && $link == 'itd') {

                $data = $data->where('status', 'GA Approved')->first();
                if ($data) {
                    $data->status = 'ITD Approved';
                    $data->spv_app_by = Auth::user()->id;
                    $data->app_spv_date = Carbon::now();
                    $data->save();
                    return "Sukses Approve";
                } else {
                    throw new Exception("Not Found!");
                }
            } else {
                throw new Exception("Unauthorized!");
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
