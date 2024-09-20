<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardDosen extends Model
{
    use HasFactory;

    protected $table = 'dashboard_dosens';

    protected $fillable = [
        'id',
        'nim',
        'nama_mahasiswa',
        'tanggal_pengajuan',
        'judul_1',
        'judul_2',
        'judul_3',
        'action',
    ];
}
