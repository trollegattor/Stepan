<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{

    public function authorize()
    {

        return $this->user()->can('create', Category::class);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>['required', 'string', 'max:200'],
            'type'=>['required', 'string', 'in:single,multiple'],
            'parent_id'=>['integer', 'nullable',
                Rule::exists('categories','id')->where('name','News'),
            ],
        ];
    }
}
