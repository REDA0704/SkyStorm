<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Représente un post/article publié par un utilisateur
 */
class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'content', 'user_id'
    ];

    /**
     * Relation : un post a plusieurs likes
     * Retourne les utilisateurs qui ont liké ce post
    */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Relation : un post appartient à un utilisateur
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
