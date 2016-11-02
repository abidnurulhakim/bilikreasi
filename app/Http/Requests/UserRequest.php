<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'name' => 'required|max:255',
            'gender' => 'required|in:male,female',
            'birthday' => 'date|before:now',
            'password' => 'confirmed|min:8',
            'term_agreement' => 'accepted'
        ];
    }
}
