<?php

namespace App\Http\Requests;

use App\Models\Biography;
use Illuminate\Foundation\Http\FormRequest;

class BiographyRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'home_number' => 'nullable',
            'gender' => 'required|string',
            'birth_date' => 'required|date_format:Y-m-d',
            'role' => 'required|string',
            'mobile_number' => 'nullable',
            'address_line_one' => 'nullable',
            'address_line_two' => 'nullable',
            'postcode' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable'
        ];
    }
}
