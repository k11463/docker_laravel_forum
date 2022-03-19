<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category', 'title', 'content', 'star', 'user_id'
    ];

    protected $hidden = [
        'category', 'id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
