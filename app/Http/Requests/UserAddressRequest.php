<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressRequest extends FormRequest
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
            //
            'address_line_one' => 'required',
            'address_line_two' => 'nullable',
            'postcode' => 'required|integer',
            'user_id' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'user_id' => 'nullable'
        ];
    }
}
