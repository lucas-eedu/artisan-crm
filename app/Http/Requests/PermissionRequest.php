<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:100', Rule::unique('permissions', 'name')->ignore($this->permission)],
            'code' => ['required', 'string', 'min:2', 'max:100', Rule::unique('permissions', 'code')->ignore($this->permission)],
        ];
    }
}
