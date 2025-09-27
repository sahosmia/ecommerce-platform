<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;



class SubcategoryStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    // Prepare for validation
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }

    // Rules
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('subcategories', 'slug')->where(function ($query) {
                    return $query->where('category_id', $this->category_id);
                }),
            ],
            'category_id' => 'required|exists:categories,id',
        ];
    }

    // Messages
    public function messages(): array
    {
        return [
            'name.required' => 'The subcategory name is required.',
            'slug.unique' => 'A subcategory with this name (slug) already exists. Please choose a different name.',
            'category_id.required' => 'The subcategory must be linked to a parent category.',
            'category_id.exists' => 'The selected parent category is invalid.',
        ];
    }
}
