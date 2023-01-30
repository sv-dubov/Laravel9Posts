<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorySaveRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|min:2|max:256|unique:categories'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Title'
        ];
    }

    public function messages()
    {
        return [
            'title.min' => 'Title must have minimum 2 characters',
            'title.max' => 'Title must have maximum 256 characters'
        ];
    }
}
