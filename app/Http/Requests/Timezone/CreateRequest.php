<?php

namespace App\Http\Requests\Timezone;

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
            'abbreviation' => 'required',
            'offSet' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required'  => 'Please select client',
            'name.required' => 'Please enter name',
            'abbreviation.required' => 'Please enter abbreviation',
            'offSet.required' => 'Please enter offSet',
        ];
    }
}
