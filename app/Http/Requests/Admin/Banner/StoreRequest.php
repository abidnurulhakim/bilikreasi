<?php

namespace App\Http\Requests\Admin\Banner;

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
            'description' => 'max:255',
            'url' => 'max:255',
            'image' => 'required|image',
            'start_at' => 'date|after:now',
            'finish_at' => 'date|after:start_at',
            'order_number' => 'integer|min:0',
            'publish' => 'required|in:0,1',
        ];
    }
}
