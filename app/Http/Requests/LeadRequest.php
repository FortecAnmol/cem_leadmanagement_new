<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
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
            'source_id' => 'required',
            'company_name' => 'required|min:3|max:20',
            'prospect_first_name' => 'required|min:3|max:20',
            'prospect_last_name' => 'required|min:3|max:20',
            'job_title' => 'required|min:3|max:20',
            'prospect_email' => 'required|email|unique:leads',
            'contact_number_1' => 'required|min:10|numeric|unique:leads',
            'web_address' => 'required|min:3',
            'employee_size' => 'required|numeric',
            'revenue_size' => 'required|numeric',
            'company_industry' => 'required|min:3|max:20',
            'physical_address' => 'required|min:3|max:50',
            'city' => 'required|min:3|max:20',
            'state' => 'required|min:3|max:20',
            'zip_code' => 'required|min:3|max:20',
            'country' => 'required|min:3|max:20',
            'linkedin_address' => 'required|min:3',
            
        ];


    }
}
