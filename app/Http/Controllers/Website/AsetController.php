<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use Carbon\Carbon;
use App\Models\Izin;
use App\Models\Barang;

class AsetController extends Controller
{
    public function show_control()
    {
        return view('website.pages.izin.control');
    }

    public function ajax_show_control(Request $request)
    {
        $data = Barang::join('izin', 'barang.izin_id', 'izin.id')
            ->select('izin.reg_no', 'nama_barang', 'jumlah', 'satuan', 'izin.created_at', 'tgl_kembali', 'keterangan_kembali');
        if (!Auth::user()->hasPermissionTo('itd_app')) {
            // return Auth::user()->department->id;
            $data = $data->where('izin.created_dept', Auth::user()->department->id);
        }

        // return "ga masuk sini";

        if ($request->filter == 'Overdue') {

            $today = Carbon::now()->format('Y-m-d');
            $data  = $data->where('barang.keterangan_kembali', 0)
                ->whereDate('barang.tgl_kembali', '<', $today);
        }
        if ($request->filter == 'Sedang Dipinjam') {
            $today = Carbon::now()->format('Y-m-d');
            $data  = $data->where('barang.keterangan_kembali', 0)
                ->whereDate('barang.tgl_kembali', '>=', $today);
        }
        $data = $data->orderBy('barang.id', 'desc')->get();
        return DataTables::of($data)->make(true);
        // return $data;
    }
}
