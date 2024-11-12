<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title' => 'required',
            'identifier' => 'required|unique:products',
            'company_id' => 'required',
            'category_id' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'identifier.required' => 'A identifier is required',
            'company_id.required' => 'You need to choose a company',
            'category_id.required' => 'You need to choose a category',
            'price.required' => 'A price is required',
        ];
    }
}
