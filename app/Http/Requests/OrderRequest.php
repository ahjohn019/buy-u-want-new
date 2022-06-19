<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'number' => 'required',
            'total' => 'required|numeric|between:0.00,9999.99',
            'grand_total' => 'required|numeric|between:0.00,9999.99',
            'tax' => 'nullable',
            'status' => 'required',
            'user_id' => 'required',
        ];
    }
}
