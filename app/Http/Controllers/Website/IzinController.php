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

class IzinController extends Controller
{
    public function create()
    {
        return view('website.pages.izin.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        try {
            $request->validate([
                'tujuan_pekerjaan' => 'required',
                'tujuan_alamat' => 'required',
                'jenis_kembali' => 'required',
                'kategori_keluar' => 'required',
                'jenis_barang' => 'required',
            ]);


            DB::transaction(function () use ($request) {
                $spv_app = null;
                $mgr_app = null;
                $spv_app_by = null;
                $mgr_app_by = null;
                $status = 'Created';
                $user = Auth::user();

                if ($user->hasPermissionTo('spv_app')) {
                    $spv_app = Carbon::now();
                    $status = 'SPV Approved';
                    $spv_app_by = $user->id;
                }
                if ($user->hasPermissionTo('mgr_app')) {
                    $spv_app = Carbon::now();
                    $mgr_app = Carbon::now();
                    $spv_app_by = $user->id;
                    $mgr_app_by = $user->id;
                    $status = 'MGR Approved';
                }
                $izin = Izin::create([
                    'reg_no' => '12345',
                    'tujuan_pekerjaan' => $request->tujuan_pekerjaan,
                    'tujuan_alamat' => $request->tujuan_alamat,
                    'jenis_kembali' => $request->jenis_kembali,
                    'kategori_keluar' => $request->kategori_keluar,
                    'jenis_barang' => $request->jenis_barang,
                    'created_by' => $user->id,
                    'created_dept' => $user->department->id,
                    'app_spv_date' => $spv_app,
                    'app_mgr_date' => $mgr_app,
                    'spv_app_by' => $spv_app_by,
                    'mgr_app_by' => $mgr_app_by,
                    'status' => $status,
                ]);

                $date = Carbon::now();
                $reg_no = $izin->id . '/' . 'GA/FIMBKA/' . $date->format('m') . '/' . $date->format('Y');
                $izin->reg_no = $reg_no;
                $izin->save();

                for ($i = 0; $i < count($request->nama_barang); $i++) {
                    Barang::create([
                        'izin_id' => $izin->id,
                        'nama_barang' => $request->nama_barang[$i],
                        'jumlah' => $request->jumlah[$i],
                        'satuan' => $request->satuan[$i],
                        'tgl_kembali' => $request->tgl_kembali[$i],
                        'keterangan' => $request->keterangan[$i],
                    ]);
                }
            });
            return redirect()->back()->with('success', 'Sukses Menyimpan Data');
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function show()
    {
        return view('website.pages.izin.show');
    }

    public function ajax_show()
    {
        $data = Izin::select('izin.id', 'reg_no', DB::Raw('users.name as creator_name'), 'izin.created_at', 'status')
            ->join('users', 'izin.created_by', 'users.id')
            ->where('izin.created_dept', Auth::user()->department->id)
            ->orderBy('izin.id', 'desc')->with('barang')->get();
        return DataTables::of($data)->make(true);
    }
}
