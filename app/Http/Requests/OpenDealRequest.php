<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpenDealRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'string|required',
            'email' => ['required', 'email'],
            'phone' => ['required'],
        ];
    }

    public function validated($key = null, $default = null) : array
    {
        return array_merge(parent::validated(), [
            'employee_id' => auth()->id(),
        ]);
    }
}
