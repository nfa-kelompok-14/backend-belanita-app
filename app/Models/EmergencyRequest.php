<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyRequest extends Model
{
    protected $table = 'emergency_requests';

    protected $fillable = ['contacted_via', 'user_id', 'notification_status', 'status'];

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }
}
