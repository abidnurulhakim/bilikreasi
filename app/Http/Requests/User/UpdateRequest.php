<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = User::where('username', $this->route('user'))->first();
        return $user && (\Auth::user()->id == $user->id || \Auth::user()->isAdmin());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'photo' => 'image',
            'name' => 'required|max:255',
            'gender' => 'required|in:male,female',
            'birthday' => 'date|before:now',
            'phone_number' => 'max:255',
        ];
        if (!empty($this->request->get('password'))) {
            $rules['password'] = 'confirmed|min:8';
        }
        return $rules;
    }
}
