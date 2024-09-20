<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KecocokanKriteria extends Model
{
    use HasFactory;

    protected $table = 'kecocokan_kriteria';

    protected $fillable = [
        'id',
        'dosen_id',
        'kode_kriteria',
        'nilai',
    ];
}
