<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    use HasFactory;

    //nom de la fonction au singulier car 1 seul message en relation
    //cardinalité 1,1
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // idem
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'image',
        'tags',
        'post_id',
        'user_id'
    ];

}
