<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            'content' => ['required', 'string', 'max:20'],
        ];

        if ($this->isMethod('post')) {
            $rules['category_id'] = ['required', 'exists:categories,id'];
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
        $messages = [
            'content.required' => 'Todoを入力してください',
            'content.string' => 'Todoを文字列で入力してください',
            'content.max' => 'Todoを20文字以下で入力してください',
        ];

        if ($this->isMethod('post')) {
            $messages['category_id.required'] = 'カテゴリを選択してください';
            $messages['category_id.exists'] = '選択したカテゴリが存在しません';
        }

        return $messages;
    }
}
