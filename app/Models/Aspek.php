<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspek extends Model
{
    use HasFactory;
    
    protected $table = 'aspeks';

    protected $fillable = [
        'id',
        'kode_aspek',
        'nama_aspek',
        'kategori',
        'action',
    ];
}
