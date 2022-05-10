<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
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
           'file'          => 'required|mimes:csv,txt',
           'source_name' => 'required|max:255',
           'description' => 'required|max:255',
           'start_date' => 'required',
           'end_date' => 'required',
        ];
    }
}
