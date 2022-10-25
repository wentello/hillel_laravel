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
        return $this->belongsToMany(Category::class, 'post_type', 'post_id', 'post_type');
    }

    public function postTagCategories()
    {
        return $this->morphMany(Category::class, 'post_tag');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
