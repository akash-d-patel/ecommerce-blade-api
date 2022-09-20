<?php

namespace App\Http\Requests\Address;

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
            'mobile_no' => 'required',
            'address_line1' => 'required',
            'landmark' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'pin_code' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'client_id.required'  => 'Please select client',
            'name.required' => 'Please enter name',
            'mobile_no.required' => 'Please enter mobile number',
            'address_line1.required' => 'Please enter address line1',
            'landmark.required' => 'Please enter landmark',
            'country_id.required' => 'Please select country',
            'state_id.required' => 'Please select state',
            'city_id.required' => 'Please select city',
            'pin_code.required' => 'Please enter pin code',
        ];
    }
}
