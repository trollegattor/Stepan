<?php

namespace App\Http\Requests;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;

class DestroyMenuRequest extends FormRequest
{
    /**
     * @param Menu $menu
     * @return bool
     */
    public function authorize(Menu $menu): bool
    {
        return $this->user()->can('delete',$menu);
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
