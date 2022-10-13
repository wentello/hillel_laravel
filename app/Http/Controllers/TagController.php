<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $title = 'Categories';
        $tags = Tag::all();

        $postTags = new PostTag();
        $postTags->posts();
        $objPostTags = $postTags->get();
        $arrPostTags = [];
        foreach ($objPostTags as $postTag){
            $arrPostTags[$postTag->tag_id][] = Post::find($postTag->post_id);
        }

        return view('tags/list', compact('title', 'tags', 'arrPostTags', 'postTags'));
    }

    public function delete($id)
    {
        if (empty($id)) {
            return new RedirectResponse('/tags');
        }
        $tag = Tag::find($id);
        $tag->posts()->detach();
        $tag->delete();
        return redirect()->route('tag.index');
    }

    public function edit($id)
    {
        $pageTitle = 'Update Tag';

        if (empty($id)) {
            return redirect()->route('tag.index');
        }
        $data = !empty($_SESSION['data']) ? $_SESSION['data'] : Tag::find($id);
        if (empty($data)) {
            return new RedirectResponse('/tags');
        }
        $posts = Post::all();
        return view('tags/edit', compact('pageTitle','data', 'id', 'posts'));
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
            'post_id' => [
                'required',
                'numeric',
            ],
        ]);

        if (!empty($request->id)) {
            $tag = Tag::find($request->id);
            $tag->update($request->all());
            $tag->posts()->attach([
                $request->post_id,
            ]);
        } else {
            $tag = Tag::create($request->all());
            $tag->posts()->attach([
                $request->post_id,
            ]);
        }

        return redirect()->route('tag.index');
    }

    public function create()
    {
        $data = !empty($_SESSION['data']) ? $_SESSION['data'] : [];
        if (empty($data)) {
            $data = ['title' => '', 'slug' => ''];
        }
        $pageTitle = 'Add Tag';
        $posts = Post::all();
        return view('tags/create', compact('pageTitle','data', 'posts'));
    }
}
