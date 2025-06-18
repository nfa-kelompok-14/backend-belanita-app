<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $table = 'complaints';

    protected $fillable = ['subject', 'description', 'status', 'user_id', 'location', 'image', 'date', 'phone'];

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }


}
