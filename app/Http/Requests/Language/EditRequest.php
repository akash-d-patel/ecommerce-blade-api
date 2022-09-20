<?php

namespace App\Http\Requests\Language;

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
            'name' => 'required',
            'initial' => 'required',
            'class' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required'  => 'Please select client',
            'name.required' => 'Please enter name',
            'initial.required' => 'Please enter initial',
            'class.required' => 'Please enter class',
        ];
    }
}
