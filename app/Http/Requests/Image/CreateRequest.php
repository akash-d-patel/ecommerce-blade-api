<?php

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'title' => 'required',
            'alt' => 'required',
            'path' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter title',
            'alt.required' => 'Please enter alt',
            'path.required' => 'Please select image path',
        ];
    }
}
