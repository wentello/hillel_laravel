<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $title = 'Posts';
        $posts = Post::all();

        return view('admin/post/list', compact('title', 'posts'));
    }

    public function delete($id)
    {
        if (empty($id)) {
            return redirect()->route('admin.post.index');
        }
        $post = Post::find($id);
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.post.index');
    }

    public function edit($id)
    {
        $pageTitle = 'Update Post';

        if (empty($id)) {
            return redirect()->route('post.index');
        }
        $data = !empty($_SESSION['data']) ? $_SESSION['data'] : Post::find($id);
        if (empty($data)) {
            return redirect()->route('admin.post.index');
        }
        $categories = Category::all();
        return view('admin/post/edit', compact('pageTitle', 'data', 'id', 'categories'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'min:3',
            ],
            'body' => [
                'required',
                'min:5',
            ],
            'category_id' => [
                'required',
                'numeric',
            ],
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::id();
        if (!empty($request->id)) {
            $post = Post::find($request->id);
            $post->update($data);
        } else {
            Post::create($data);
        }

        return redirect()->route('admin.post.index');
    }

    public function create()
    {
        $pageTitle = 'Add Post';
        $categories = Category::all();
        return view('admin/post/create', compact('pageTitle', 'categories'));
    }
}
