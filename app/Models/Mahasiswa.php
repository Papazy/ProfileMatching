<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Mahasiswa extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'mahasiswas';

    protected $fillable = [
        'id',
        'nim',
        'nama_mahasiswa',
        'jenis_kelamin',
        'no_hp',
        'role_id',
        'password',
        'action',
    ];

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id');
    }
}