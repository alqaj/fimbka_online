<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Exception;
use DataTables;
use App\Models\Izin;
use App\Models\Barang;

class ConfirmController extends Controller
{
    public function show_confirmation()
    {
        return view('website.pages.izin.show_confirmation');
    }

    public function ajax_show_confirmation()
    {
        $data = Izin::select('izin.id', 'reg_no', DB::Raw('users.name as creator_name'), 'izin.created_at', 'status')
            ->join('users', 'izin.created_by', 'users.id')
            ->where('izin.created_dept', Auth::user()->department->id)
            ->where('izin.status', 'ITD Approved')
            ->with('barang')
            ->get();
        return DataTables::of($data)->make(true);
    }

    public function confirm_ajax(Request $request)
    {
        try {
            // $data = Barang::join('izin', 'barang.izin_id', 'izin.id')
            //     ->where('barang.id', $request->id_barang)
            //     ->where('izin.created_dept', Auth::user()->department->id)
            //     ->first();
            $data = Barang::find($request->id_barang);
            if ($data->izin->created_dept != Auth::user()->department->id) {
                throw new Exception("Unauthorized!");
            }
            if ($data) {
                $data->keterangan_kembali = true;
                $data->confirm_by = Auth::user()->id;
                $data->save();
                // return $data;
            } else {
                throw new Exception("Not Found!");
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
