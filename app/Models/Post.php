<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Facades\Auth;

class Post extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'user_id', 
        'image_path', 
        'caption', 
        'location'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    // Helper to check if post is liked by current user
    public function isLikedBy($userId = null)
    {
        $userId = $userId ?? Auth::id();
        return $this->likes()->where('user_id', $userId)->exists();
    }
}
