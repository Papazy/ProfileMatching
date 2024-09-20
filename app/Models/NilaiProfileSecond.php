<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiProfileSecond extends Model
{
    use HasFactory;

    protected $table = 'nilai_profile_seconds';

    protected $fillable = [
        'id',
        'nidn',
        'nama_dosen',
        'K5',
        'action',
    ];
}
