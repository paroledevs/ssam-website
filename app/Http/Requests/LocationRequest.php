<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cover' => 'image|max:1500',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     **/
    public function messages()
    {
        return [
            'cover.image' => 'Choose and image',
            'cover.max' => 'Please check the size of the image, max. 1.5MB each',
        ];
    }
}
