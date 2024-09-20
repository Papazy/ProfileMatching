<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Dosen extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'dosens';

    protected $fillable = [
        'id',
        'nidn',
        'nama_dosen',
        'no_hp',
        'role_id',
        'password',
        'action',
    ];



    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id');
    }

    public function kategoris()
{
    return $this->belongsToMany(Kategori::class, 'dosen_kategori');
}
}

