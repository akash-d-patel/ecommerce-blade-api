<?php

namespace App\Http\Requests\Coupon;

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
            'code' => 'required|unique:coupons,code',
            'maximum_discount' => 'required|between:0,99.99',
            'discount_type' => 'required',
            'no_of_attemets' => 'required',
            'expire_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required'  => 'Please select client',
            'code.required' => 'Please enter code',
            'maximum_discount.required' => 'Please enter maximum discount',
            'discount_type.required' => 'Please select discount type',
            'no_of_attemets.required' => 'Please select discount type',
            'expire_date.required' => 'Please select expire date',
        ];
    }
}
