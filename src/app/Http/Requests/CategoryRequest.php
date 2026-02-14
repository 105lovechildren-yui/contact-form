<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:10'],
        ];

        if ($this->isMethod('post')) {
            $rules['name'][] = Rule::unique('categories', 'name');
        }

        if ($this->isMethod('patch')) {
            $rules['name'][] = Rule::unique('categories', 'name')->ignore($this->route('id'));
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'カテゴリを入力してください',
            'name.string' => 'カテゴリを文字列で入力してください',
            'name.max' => 'カテゴリを10文字以下で入力してください',
            'name.unique' => 'カテゴリは既に使用されています',
        ];
    }
}
