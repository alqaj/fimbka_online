<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'izin_id',
        'nama_barang',
        'jumlah',
        'satuan',
        'tgl_kembali',
        'keterangan',
        'keterangan_kembali',
        'confirm_by'
    ];

    protected $table = 'barang';

    public function izin()
    {
        return $this->belongsTo('App\Models\Izin', 'izin_id', 'id');
    }
}
