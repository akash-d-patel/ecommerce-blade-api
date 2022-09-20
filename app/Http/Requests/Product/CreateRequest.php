<?php

namespace App\Http\Requests\Product;

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
            'client_id' => 'required',
            'name' => 'required',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'client_id.required'  => 'Please select client',
            'description.required' => 'Please enter description',
        ];
    }
}
