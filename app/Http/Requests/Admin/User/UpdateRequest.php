<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo' => 'image',
            'name' => 'required|max:255',
            'gender' => 'required|in:male,female',
            'birthday' => 'date|before:now',
            'phone_number' => 'max:255',
            'interests' => '',
            'skills' => '',
            'live_at' => '',
            'profession' => '',
            'role' => 'required|in:'.join(',', array_keys(\App\Models\User::TYPE)),
        ];
    }
}
