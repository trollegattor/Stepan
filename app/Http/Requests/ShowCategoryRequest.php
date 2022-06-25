<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class ShowCategoryRequest extends FormRequest
{

    public function authorize()
    {
        $category = Category::query()->find($this->route('category'));


        return $this->user()->can('view', $category);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
           'id'=>'exists:categories,id'
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge(['id' => request()->route('category')]);
    }
}
