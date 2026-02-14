@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
{{-- アラートメッセージ --}}
@if (session('message'))
<div class="todo__alert">
    <p class="todo__alert-message">{{ session('message') }}</p>
</div>
@endif

{{-- バリデーションエラーメッセージ --}}
@if ($errors->any())
<div class="todo__error">
    <ul class="todo__error-list">
        @foreach ($errors->all() as $error)
        <li class="todo__error-item">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="todo__content">
    <div class="todo__section">
        <h2 class="todo__section-title">新規作成</h2>
        <form action="{{ route('todos.store') }}" method="POST" class="todo__form">
            @csrf
            <input type="text" name="content" class="todo__form-input" placeholder="Todoを入力" value="{{ old('content') }}">
            <select name="category_id" class="todo__form-select">
                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>カテゴリ</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="todo__form-button">作成</button>
        </form>
    </div>

    <div class="todo__section">
        <h2 class="todo__section-title">Todo検索</h2>
        <form action="{{ route('todos.index') }}" method="GET" class="todo__form">
            <input type="hidden" name="search" value="1">
            <input type="text" name="keyword" class="todo__form-input" placeholder="Todoを入力" value="{{ request('keyword') }}">
            <select name="search_category_id" class="todo__form-select">
                <option value="">カテゴリ</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ (string) request('search_category_id') === (string) $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="todo__form-button">検索</button>
        </form>
    </div>

    {{-- Todoテーブル --}}
    <table class="todo__table">
        <thead class="todo__table-header">
            <tr class="todo__table-row">
                <th class="todo__table-heading">Todo</th>
                <th class="todo__table-heading">カテゴリ</th>
            </tr>
        </thead>
        <tbody class="todo__table-body">
            @foreach ($todos as $todo)
            <tr class="todo__table-row">
                <td class="todo__table-data">
                    <div class="todo__item">
                        <form action="{{ route('todos.update', $todo->id) }}" method="POST" class="todo__item-form todo__item-form--update" id="todo-update-{{ $todo->id }}">
                            @csrf
                            @method('PATCH')
                            <input type="text" name="content" class="todo__item-text" value="{{ $todo->content }}">
                        </form>
                        <div class="todo__item-actions">
                            <button type="submit" class="todo__item-button todo__item-button--update" form="todo-update-{{ $todo->id }}">更新</button>
                            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="todo__item-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="todo__item-button todo__item-button--delete">削除</button>
                            </form>
                        </div>
                    </div>
                </td>
                <td class="todo__table-data">{{ optional($todo->category)->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection