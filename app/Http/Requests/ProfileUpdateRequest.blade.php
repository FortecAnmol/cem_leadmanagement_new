<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'first_name' => 'required|min:3|max:20',
            'last_name' => 'required|min:3|max:20',
            //'email' => 'required|email|unique:leads',
            //'phone_no' => 'required|min:10|numeric|unique:leads',
            'address' => 'required|min:3',
            //'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
     
            
        ];


    }
}
