<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiProfile extends Model
{
    use HasFactory;

    protected $table = 'nilai_profil';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'mahasiswa_id',
        'dosen_id',
        'kode_kriteria',
        'nilai_kriteria',
        'nilai_kesesuaian',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }
}
