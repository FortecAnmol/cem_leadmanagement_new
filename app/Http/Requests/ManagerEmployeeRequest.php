<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerEmployeeRequest extends FormRequest
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
            'manager_id' => 'required',
            'first_name' => 'required|min:3|max:20',
            'last_name' => 'required|min:3|max:20',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'phone_no' => 'required|min:10|numeric|unique:users,phone_no,NULL,id,deleted_at,NULL',
            'address' => 'required|min:3|max:30',
        ];
    }
}
