<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = ['title', 'image', 'content', 'status', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }
}
