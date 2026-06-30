<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaProlanis extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'no_bpjs',
        'nama',
        'alamat',
        'no_hp',
        'diagnosa',
    ];
}
