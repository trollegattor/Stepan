<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class DestroyCategoryRequest extends FormRequest
{
    /**
     * @param Category $category
     * @return bool
     */
    public function authorize(Category $category): bool
    {
        return  $this->user()->can('delete', $category);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
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
