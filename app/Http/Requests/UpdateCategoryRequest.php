<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        $category = Category::query()->find($this->route('category'));

        return $this->user()->can('update', $category);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'exists:categories,id',
            'name' => ['required', 'string', 'max:200'],
            'type' => ['required', 'string', 'in:single,multiple'],
            'parent_id' => ['integer', 'nullable',
                Rule::exists('categories', 'id')->where('name', 'News'),
            ],
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
