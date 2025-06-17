<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = ['user_id', 'complaint_id', 'message'];

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function complaint() {
        return $this->belongsTo(Complaint::class, "complaint_id");
    }
}
