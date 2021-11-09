<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            // estou editando o usuário e a senha está em branco (logo, não preciso validar a senha)
            return [
                'name' => 'required|string|min:2|max:255',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
                'profile_id' => 'required'
            ];
        } else {
            return [
                'name' => 'required|string|min:2|max:255',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
                'password' => 'required|string|min:8',
                'profile_id' => 'required'
            ];
        }
    }
}
