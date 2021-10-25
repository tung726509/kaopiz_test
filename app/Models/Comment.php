<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content_comment','user_id','post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class)->withDefault([
            // 'name' => null,
        ]);
    }
}
