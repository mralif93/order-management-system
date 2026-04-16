<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product')?->id;

        return [
            'name'        => 'required|string|max:255',
            'sku'         => "required|string|max:50|unique:products,sku,{$productId}",
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'currency'    => 'required|string|max:3',
            'quantity'    => 'required|integer|min:0',
            'is_active'   => 'boolean',
        ];
    }
}

