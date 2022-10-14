<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $title = 'Categories';
        $categories = Category::all();

        return view('category/list', [
            'title' => $title,
            'categories' => $categories,
        ]);
    }

    public function delete($id)
    {
        if (empty($id)) {
            return new RedirectResponse('/category');
        }
        $category = Category::find($id);
        $category->posts()->delete();
        $category->delete();

        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $pageTitle = 'Update Categories';

        if (empty($id)) {
            return new RedirectResponse('/category');
        }
        $data = !empty($_SESSION['data']) ? $_SESSION['data'] : Category::find($id);
        if (empty($data)) {
            return new RedirectResponse('/category');
        }

        return view('category/edit', compact('pageTitle','data', 'id'));
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
            $category = Category::find($request->id);
            $category->update($request->all());
        } else {
            Category::create($request->all());
        }

        return redirect()->route('category.index');
    }

    public function create()
    {
        $data = !empty($_SESSION['data']) ? $_SESSION['data'] : [];
        if (empty($data)) {
            $data = ['title' => '', 'slug' => ''];
        }

        $pageTitle = 'Add Categories';

        return view('category/create', compact('pageTitle','data'));
    }
}
