<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table = "roles";
    protected $primaryKey = "role_id";
    protected $fillable = [
        'nama_role',
    ];

    public function user()
    {
        return $this->hasMany(user::class, 'role_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(mahasiswa::class, 'role_id');
    }

    public function dosen()
    {
        return $this->hasMany(dosen::class, 'role_id');
    }
}
