<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'nama_department',
        'singkatan'
    ];

    protected $table = 'department';
}
