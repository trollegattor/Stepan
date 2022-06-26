<?php

namespace App\Http\Requests;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
{
    /**
     * @param Menu $menu
     * @return bool
     */
    public function authorize(Menu $menu): bool
    {
        return $this->user()->can('update',$menu);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=>'exists:menus,id',
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:200'],
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
