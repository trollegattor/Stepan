<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'login' => ['required', 'string', 'max:50'],
            'password' => ['required', 'min:8'],
            'email' => ['email:rfc','unique:App\Models\User,email'],
            'role_id' => ['required', 'exists:roles,id',Rule::notIn([1,2,3])],
            'real_name' => ['required', 'string', 'max:50'],
            'surname' => ['required', 'string', 'max:50'],
        ];
    }
}