<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /** @var mixed $user */
    public mixed $user;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $id = $this->route('user');
        $user = User::query()->find($id);
        $this->user = $user;

        return $this->user()->can('update', $user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'exists:users,id',
            'login' => ['required', 'string', 'max:50',
                Rule::unique('users')->ignore($this->user->id)],
            'password' => ['required', 'min:8'],
            'email' => ['email:rfc',
                Rule::unique('users')->ignore($this->user->id)],
            'role_id' => ['required', 'exists:roles,id', Rule::notIn([1, 2, 3])],
            'real_name' => ['required', 'string', 'max:50'],
            'surname' => ['required', 'string', 'max:50'],
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge(['id' => request()->route('user')]);
    }

}
