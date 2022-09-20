<?php

namespace App\Http\Requests\Review;

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
            'content' => 'required',
            'rate' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Please enter content',
            'rate.required' => 'Please enter rating',
            'status.required' => 'Please enter status',

        ];
    }
}
