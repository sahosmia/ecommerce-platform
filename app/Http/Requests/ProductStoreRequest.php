<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class ProductStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

     // Merge for validation
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
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',

            'slug' => 'required|string|max:255|unique:products,slug',

            'image' => 'nullable|image|max:2048',

            'price' => 'required|numeric|min:0',
            'discount_type' => 'required|in:fixed,percentage',
            'discount_value' => 'nullable|numeric|min:0',
        ];
    }

    // Validation  Messages
    public function messages(): array
    {
        return [
            'category_id.required' => 'The product must be assigned to a category.',
            'category_id.exists' => 'The selected category is invalid.',
            'subcategory_id.required' => 'The product must be assigned to a subcategory.',
            'subcategory_id.exists' => 'The selected subcategory is invalid.',
            'name.required' => 'The product name is required.',

            'slug.unique' => 'This product name generates a slug that already exists. Please modify the product name.',

            'image.image' => 'The file must be a valid image format.',
            'image.max' => 'The image size must not exceed 2 MB.',

            'price.required' => 'The price is required.',
            'price.min' => 'The price must be a positive number.',
            'discount_type.required' => 'The discount type (Fixed or Percentage) is required.',
            'discount_type.in' => 'Invalid discount type selected.',
            'discount_value.min' => 'The discount value must be zero or a positive number.',
        ];
    }
}
