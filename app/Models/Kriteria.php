<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';

    protected $fillable = [
        'id',
        'kode_kriteria',
        'kode_aspek',
        'nama_kriteria',
        'nilai',
        'action',
    ];
}
