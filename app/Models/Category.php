<?php

namespace App\Models;

use App\Models\Post;
use App\Models\PostType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function postTagCategories()
    {
        return $this->morphMany(Post::class, 'postable',1,2,3,4);
    }

    public function postable(){
        return $this->morphToMany(Post::class, 'postable');
    }
}
