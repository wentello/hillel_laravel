<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $title = 'Categories';
        $categories = Category::all();

        return view('/admin/category/list', [
            'title' => $title,
            'categories' => $categories,
        ]);
    }

    public function delete($id)
    {
        if (empty($id)) {
            return new RedirectResponse('/admin/category');
        }
        $category = Category::find($id);
        $category->posts()->delete();
        $category->delete();

        return redirect()->route('admin.category.index');
    }

    public function edit($id)
    {
        $pageTitle = 'Update Categories';

        if (empty($id)) {
            return new RedirectResponse('/ruth/category');
        }
        $data = Category::find($id);
        if (empty($data)) {
            return new RedirectResponse('/category');
        }

        return view('/admin/category/edit', compact('pageTitle','data', 'id'));
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

        return redirect()->route('admin.category.index');
    }

    public function create()
    {
        $pageTitle = 'Add Categories';

        return view('/admin/category/create', compact('pageTitle'));
    }
}
