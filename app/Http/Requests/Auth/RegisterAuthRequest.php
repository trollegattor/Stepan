<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;


class RegisterAuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
           'login'=>['required','string','max:50'],
            'password'=>['required', Password::min(8)->numbers()],
            'email'=>['email:rfc','unique:App\Models\User,email'],
            'role_id'=>['required','exists:roles,id',Rule::notIn([1,2,3])],
            'real_name'=>['required','string','max:50'],
            'surname'=>['required','string','max:50']

        ];
    }
}
