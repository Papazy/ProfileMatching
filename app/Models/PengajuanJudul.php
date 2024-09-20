<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanJudul extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_juduls';
    
    protected $fillable = [
        'nim',
        'tanggal_pengajuan',
        'mahasiswa_id',
        'dosen_id',
        'judul',
        'status',
        'dospem_1',
        'dospem_2',
        'tgl_approve',
        'keterangan'
    ];
}
