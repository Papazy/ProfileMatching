<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcategoryRelation extends Model
{
    use HasFactory;

    protected $fillable = ['subcategory1_id', 'subcategory2_id', 'score'];

    public function subcategory1()
    {
        return $this->belongsTo(Kategori::class, 'subcategory1_id');
    }

    public function subcategory2()
    {
        return $this->belongsTo(Kategori::class, 'subcategory2_id');
    }
}
