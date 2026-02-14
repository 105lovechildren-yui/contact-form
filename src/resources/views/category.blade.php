@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
@if (session('message'))
<div class="todo__alert">
    <p class="todo__alert-message">{{ session('message') }}</p>
</div>
@endif

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
        <form action="{{ route('category.store') }}" method="POST" class="todo__form">
            @csrf
            <input type="text" name="name" class="todo__form-input" placeholder="カテゴリ名を入力" value="{{ old('name') }}">
            <button type="submit" class="todo__form-button">作成</button>
        </form>
    </div>

    <table class="todo__table">
        <thead class="todo__table-header">
            <tr class="todo__table-row">
                <th class="todo__table-heading">category</th>
            </tr>
        </thead>
        <tbody class="todo__table-body">
            @foreach ($categories as $category)
            <tr class="todo__table-row">
                <td class="todo__table-data">
                    <div class="todo__item">
                        <form action="{{ route('category.update', $category->id) }}" method="POST" class="todo__item-form todo__item-form--update" id="category-update-{{ $category->id }}">
                            @csrf
                            @method('PATCH')
                            <input type="text" name="name" class="todo__item-text" value="{{ $category->name }}">
                        </form>
                        <div class="todo__item-actions">
                            <button type="submit" class="todo__item-button todo__item-button--update" form="category-update-{{ $category->id }}">更新</button>
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="todo__item-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="todo__item-button todo__item-button--delete">削除</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection