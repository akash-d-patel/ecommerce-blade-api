<?php

namespace App\Http\Requests\Country;

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
            'name' => 'required',
            'client_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required'  => 'Please select client',
            'name.required' => 'Please enter name',
        ];
    }
}
