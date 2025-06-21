<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    protected $table = 'merchandises';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'merchandise_category_id',
    ];
    public function merchandiseCategory() {
        return $this->belongsTo(merchandiseCategory::class, "merchandise_category_id");
    }
}
