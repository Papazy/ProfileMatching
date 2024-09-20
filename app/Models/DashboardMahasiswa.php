<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'dashboard_mahasiswas';

    protected $fillable = [
        'id',
        'nim',
        'nama_mahasiswa',
        'judul_skripsi',
        'tanggal_ACC',
        'dosen_pembimbing_1',
        'dosen_pembimbing_2',
    ];

    
}
