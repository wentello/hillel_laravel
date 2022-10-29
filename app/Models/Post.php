<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'category_id',
        'user_id',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_type', 'postable_id', 'postable_type', 'id1', 'id2');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
