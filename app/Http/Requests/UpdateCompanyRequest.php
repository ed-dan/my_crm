<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'company_phone' => 'required',
            'address' => '',
            'website' => '',
            'description' =>'',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'company_phone.required' => 'A company phone is required',

            
        ];
    }
}
