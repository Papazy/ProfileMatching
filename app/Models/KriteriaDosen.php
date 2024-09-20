<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaDosen extends Model
{
    use HasFactory;

    protected $table = 'kriteria_dos';

    protected $fillable = [
        'id',
        'dosen_id',
        'kode_kriteria',
        'keterangan',
    ];
    public $timestamps = false;

}
