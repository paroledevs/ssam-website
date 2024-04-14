<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => [
                'required', 'email', Rule::unique('users')->ignore(optional($this->user)->id),
            ],
            'password' => optional($this->user)->id ? 'confirmed' : 'required|confirmed',
            'avatar' => 'file|max:350',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Type a name',
            'email.required' => 'Type an email',
            'email.email' => 'Type a valid email',
            'email.unique' => 'This email is already in use',
            'password.confirmed' => 'Passwords do not match',
            'avatar.max' => 'Please check the size of the image, max. 350KB',
        ];
    }
}
