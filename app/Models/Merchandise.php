<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MerchandiseCategory; 

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
        return $this->belongsTo(MerchandiseCategory::class, "merchandise_category_id");
    }
}
