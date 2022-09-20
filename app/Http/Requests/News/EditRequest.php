<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'client_id' => 'required',
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'client_id.required'  => 'Please select client',
            'title.required' => 'Please enter title',
            'short_description.required' => 'Please enter short description',
            'description.required' => 'Please enter description',
        ];
    }
}
