<?php

namespace App\Http\Requests;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;

class ShowMenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Menu $menu)
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
            'id'=>'exists:menus,id'
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge(['id' => request()->route('menu')]);
    }
}
