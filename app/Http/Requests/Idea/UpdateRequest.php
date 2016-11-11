<?php

namespace App\Http\Requests\Idea;

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
            'title' => 'required|max:255',
            'description' => 'required',
            'cover' => 'max:2048',
            'category' => 'required|in:'.join(',', array_keys(\App\Models\Idea::CATEGORY)),
            'tag' => '',
            'location' => '',
            'status' => 'required|in:'.join(',', array_keys(\App\Models\Idea::STATUS)),
            'media' => 'array|max:10120',
        ];
    }
}
