<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class PostController extends Controller
{
    public function index()
    {
        $title = 'Posts';

        $posts = Post::all();
        $categories = Category::all();
        $users = User::all();

        return view('post/list', [
            'title' => $title,
            'posts' => $posts,
            'categories' => $categories,
            'users' => $users,
        ]);
    }

    public function authorCategory($author, $category)
    {
        $title = 'Author';
        $posts = Post::where('category_id', trim($category))->where('user_id', trim($author))->get();
        $categories = Category::find(trim($category));
        $users = User::find(trim($author));

        return view('post/list', [
            'title' => $title,
            'posts' => $posts,
            'categories' => [$categories],
            'users' => [$users],
        ]);
    }

    public function category($category){
        $title = 'Author';

        $posts = Post::whereHas('category', function (Builder $query) use ($category) {
            $query->where('id', '=', trim($category));
        })->get();
        $category = Category::find(trim($category));
        $users = User::all();

        return view('post/list', [
            'title' => $title,
            'posts' => $posts,
            'categories' => [$category],
            'users' => $users,
        ]);
    }

    public function author($author)
    {
        $title = 'Author';
        $posts = Post::where('user_id', trim($author))->get();
        $categories = Category::all();
        $users = User::find(trim($author));

        return view('post/list', [
            'title' => $title,
            'posts' => $posts,
            'categories' => $categories,
            'users' => [$users],
        ]);
    }

    public function delete($id)
    {
        if (empty($id)) {
            return redirect()->route('post.index');
        }
        $post = Post::find($id);
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('post.index');
    }

    public function edit($id)
    {
        $pageTitle = 'Update Post';

        if (empty($id)) {
            return redirect()->route('post.index');
        }
        $data = !empty($_SESSION['data']) ? $_SESSION['data'] : Post::find($id);
        if (empty($data)) {
            return redirect()->route('post.index');
        }
        $categories = Category::all();
        return view('post/edit', compact('pageTitle', 'data', 'id', 'categories'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'min:3',
            ],
            'slug' => [
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

        if (!empty($request->id)) {
            $post = Post::find($request->id);
            $post->update($request->all());
        } else {
            Post::create($request->all());
        }

        return redirect()->route('post.index');
    }

    public function create()
    {
        $data = !empty($_SESSION['data']) ? $_SESSION['data'] : [];

        if (empty($data)) {
            $data = ['title' => '', 'slug' => '', 'body' => ''];
        }

        $pageTitle = 'Add Post';
        $categories = Category::all();
        return view('post/create', compact('pageTitle', 'data', 'categories'));
    }
}
