<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    protected $table = 'merchandises';

    protected $fillable = ['name', 'image', 'description', 'price', 'stock', 'merchandise_categories_id'];

    
}
