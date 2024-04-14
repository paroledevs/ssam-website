<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        return [
            'main_image' => 'file|max:1500',
            'cover' => 'file|max:1500',
            'title' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Type a title',
            'main_image.max' => 'Post image is too large, max. 1.5MB',
            'cover.max' => 'Cover is too large, max. 1.5MB',
        ];
    }
}
