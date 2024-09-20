<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['kategori', 'subkategori'];

    public function dosens()
    {
        return $this->belongsToMany(Dosen::class, 'dosen_kategori');
    }
}
