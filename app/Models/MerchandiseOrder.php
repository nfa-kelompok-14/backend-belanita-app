<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchandiseOrder extends Model
{
    protected $table = 'merchandise_orders';

    protected $fillable = ['order_number', 'quantity', 'total_price', 'status', 'user_id', 'merchandise_id'];

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function merchandise() {
        return $this->belongsTo(Merchandise::class, "merchandise_id");
    }
}
