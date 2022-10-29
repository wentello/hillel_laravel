<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use function Symfony\Component\Mime\Header\get;

class PostByType extends Controller
{
    public function index($id, $postable_type = 'Category')
    {
        $title = 'PostByType';

        $q = $postable_type == 'User'? User::find($id) : Category::find($id);
        $posts = $q->postable;

        return view('admin/post/listByType', compact('title', 'posts', 'postable_type'));
    }
}
