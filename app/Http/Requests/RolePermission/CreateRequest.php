<?php

namespace App\Http\Requests\RolePermission;

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

            'role_id' => 'required',
            'permission_id' => 'required',

        ];
    }

    public function messages()
    {
        return [

            'role_id.required' => 'Please select role',
            'permission_id.required' => 'Please select permission',
        ];
    }
}
