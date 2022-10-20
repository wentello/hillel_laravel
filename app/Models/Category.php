<?php

namespace App\Models;

use App\Models\Post;
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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        return $this;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
