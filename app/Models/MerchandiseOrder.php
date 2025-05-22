<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchandiseOrder extends Model
{
    protected $table = 'merchandise_orders';
    
    protected $fillable = ['quantity', 'total_price', 'status', 'users_id', 'merchandise_id'];
}
