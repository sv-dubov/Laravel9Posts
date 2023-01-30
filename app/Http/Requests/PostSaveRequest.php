<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostSaveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' =>'required|min:10',
            'content' => 'required',
            'category_id' => 'required|exists:App\Models\Category,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Title',
            'content' => 'Content',
            'category_id' => 'Category',
            'image' => 'Image'
        ];
    }

    public function messages()
    {
        return [
            'title.min' => 'Title must have minimum 10 characters',
            'category_id' => 'Please, choose category',
            'image.max' => 'Image size must be maximum 2MB'
        ];
    }
}
