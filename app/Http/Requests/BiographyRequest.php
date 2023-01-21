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
            'gender' => 'required|string',
            'birth_date' => 'required|date_format:Y-m-d',
            'role' => 'required|string',
            'home_number' => 'nullable',
            'phone_number' => 'nullable',
            'user_id' => 'nullable'
        ];
    }
}
