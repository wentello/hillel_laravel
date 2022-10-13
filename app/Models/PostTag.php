<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;
    protected $table = 'post_tag';
    protected $fillable = [
        'post_id',
        'tag_id',
    ];

    public function posts()
    {
        return $this->belongsTo(Post::class, 'post_tag');
    }
}
