<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    protected $fillable = [
        'reg_no',
        'tujuan_pekerjaan',
        'tujuan_alamat',
        'jenis_kembali',
        'kategori_keluar',
        'jenis_barang',
        'created_by',
        'created_dept',
        'spv_app_by',
        'mgr_app_by',
        'it_app_by',
        'ga_app_by',
        'creation_date',
        'app_spv_date',
        'app_mgr_date',
        'app_it_date',
        'app_ga_date',
        'status',
    ];

    protected $table = 'izin';

    public function barang()
    {
        return $this->hasMany('App\Models\Barang', 'izin_id', 'id');
    }
}
