<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('search') && !$request->filled('keyword') && !$request->filled('search_category_id')) {
            return redirect()->route('todos.index')
                ->withErrors(['keyword' => 'Todoを入力してください'])
                ->withInput();
        }

        $categories = Category::all();

        $todos = Todo::with('category')
            ->when($request->filled('keyword'), function ($query) use ($request) {
                $query->where('content', 'like', '%' . $request->keyword . '%');
            })
            ->when($request->filled('search_category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->search_category_id);
            })
            ->get();

        return view('index', compact('todos', 'categories'));
    }

    public function store(TodoRequest $request)
    {
        Todo::create([
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('todos.index')->with('message', 'Todoを作成しました。');
    }

    public function update(TodoRequest $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update([
            'content' => $request->content,
        ]);

        return redirect()->route('todos.index')->with('message', 'Todoを更新しました。');
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return redirect()->route('todos.index')->with('message', 'Todoを削除しました。');
    }
}
