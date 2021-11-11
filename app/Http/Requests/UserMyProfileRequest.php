<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserMyProfileRequest extends FormRequest
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
        if ($this->method() == 'PUT' && !$this->password) {
            return [
                'name' => 'required|string|min:2|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
            ];
        } else {
            return [
                'name' => 'required|string|min:2|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
                'password' => 'required|string|min:8'
            ];
        }
    }
}
