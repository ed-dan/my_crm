<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required',
            'deadline' => 'required',
            'time' => 'required',
            'priority' => 'required',
            "subject" => "required"
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'subject.required' => 'A note is required',
            'priority.required' => 'A priority is required',
            'deadline.required' => 'A date is required',
            'time.required' => 'A time is required',
        ];
    }

    /**
     * @return array
     */
    public function validated($key = null, $default = null) : array
    {
        return array_merge(parent::validated(), [
            'employee_id' => auth()->id(),
            'deal_id' => 0,
        ]);
    }
}
