<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class RegisterAuthRequest extends FormRequest
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
           'login'=>['required','string','max:50'],
            'password'=>['required', Password::min(8)->numbers()],
            'email'=>['email:rfc'],
            'role_id'=>['required','exists:roles,id'],
            'real_name'=>['required','string','max:200'],
            'surname'=>['required','string','max:200']

        ];
    }
}
