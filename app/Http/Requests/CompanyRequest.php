<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:255',
            'segment' => 'nullable|string|max:50',
            'state' => 'required|string|min:2|max:2',
            'number_employees' => 'nullable|string|max:50',
            'status' => 'in:active,inactive',
        ];
    }
}
