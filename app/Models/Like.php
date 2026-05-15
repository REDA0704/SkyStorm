<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Représente un "like" sur un post
 * Table pivot entre User et Post
 */
class Like extends Model
{
    protected $fillable = ['user_id', 'post_id'];

    public function user()
    {
        //Relation : un like appartient à un utilisateur
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        //Relation : un like appartient à un post
        return $this->belongsTo(Post::class);
    }
}
