<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $title = 'Tag';
        $tags = Tag::all();

        return view('admin/tags/list', compact('title', 'tags'));
    }

    public function tag($tag)
    {
        $title = 'Author';

        $posts = Post::whereHas('tags', function (Builder $query) use ($tag) {
            $query->where('tags.id', '=', $tag);
        })->get();
        $category = Category::all();
        $users = User::all();
        $tags = Tag::find(trim($tag));
        return view('post/list', [
            'title' => $title,
            'posts' => $posts,
            'categories' => $category,
            'users' => $users,
            'tags' => [$tags],
        ]);
    }

    public function authorCategoryTag($author, $category, $tag)
    {
        $title = 'Author Category Tag';

        $posts = Post::whereHas('tags', function (Builder $query) use ($author, $category, $tag) {
            $query->where('user_id', '=', $author)->where('category_id', '=', $category)->where('tags.id', '=', $tag);
        })->get();
        $category = Category::find($category);
        $users = User::find($author);
        $tags = Tag::find($tag);
        return view('post/list', [
            'title' => $title,
            'posts' => $posts,
            'categories' => [$category],
            'users' => [$users],
            'tags' => [$tags],
        ]);
    }

    public function delete($id)
    {
        if (empty($id)) {
            return new RedirectResponse('/auth/tags');
        }
        $tag = Tag::find($id);
        $tag->posts()->detach();
        $tag->delete();
        return redirect()->route('admin.tag.index');
    }

    public function edit($id)
    {
        $pageTitle = 'Update Tag';

        if (empty($id)) {
            return redirect()->route('admin.tag.index');
        }
        $posts = Post::all();
        $data = Tag::find($id);
        $dataPosts = Post::whereHas('tags', function (Builder $query) use ($id) {
            $query->where('tag_id', '=', $id);
        })->get();

        if (empty($data)) {
            return new RedirectResponse('/auth/tags');
        }

        return view('admin/tags/edit', compact('pageTitle','data','dataPosts', 'id', 'posts'));
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
        ]);

        if (!empty($request->id)) {
            $tag = Tag::find($request->id);
            $tag->update($request->all());
        } else {
            $tag = Tag::create($request->all());
        }
        $tag->posts()->attach(
            $request->post_id
        );

        return redirect()->route('admin.tag.index');
    }

    public function create()
    {
        $pageTitle = 'Add Tag';
        $posts = Post::all();
        return view('admin/tags/create', compact('pageTitle', 'posts'));
    }
}
