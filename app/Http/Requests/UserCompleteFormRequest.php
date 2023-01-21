<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCompleteFormRequest extends FormRequest
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
        $rules = [];
        
        $userCompleteRequests = [
            BiographyRequest::class,
            UserRequest::class,
            UserAddressRequest::class,
        ];

        foreach($userCompleteRequests as $request) {
            $rules = array_merge(
                $rules,
                (new $request)->rules()
            );
        }
      
        return $rules;
    }
}
