<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorySaveRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategorySaveRequest $request)
    {
        $data = $request->validated();
        Category::create($data);
        return redirect()->route('categories.index')->with('status', 'Category created!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(CategorySaveRequest $request, $id)
    {
        $data = $request->validated();
        $category = Category::findOrFail($id);
        $category->update($data);
        return redirect()->route('categories.index')->with('status', 'Category updated!');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('categories.index');
    }
}
