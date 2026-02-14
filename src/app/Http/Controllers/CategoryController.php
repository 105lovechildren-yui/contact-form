<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('category', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('message', 'カテゴリを作成しました。');
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('message', 'カテゴリを更新しました。');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('message', 'カテゴリを削除しました。');
    }
}
