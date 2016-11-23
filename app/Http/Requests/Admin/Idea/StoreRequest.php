<?php

namespace App\Http\Requests\Admin\Idea;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required',
            'cover' => 'max:2048',
            'category' => 'required|in:'.join(',', array_keys(\App\Models\Idea::CATEGORY)),
            'tag' => '',
            'location' => '',
            'status' => 'required|in:'.join(',', array_keys(\App\Models\Idea::STATUS)),
            'media' => 'array|max:10120',
            'start_at' => 'date|after:now',
            'finish_at' => 'date|after:start_at'
        ];
    }
}
