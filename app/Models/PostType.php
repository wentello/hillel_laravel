<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    /**
     * Get the parent commentable model (post or video).
     */
    protected $table = 'post_type';

    public function post()
    {
        return $this->morphTo();
    }
}
