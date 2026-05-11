<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsSearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'q' => 'nullable|string|max:255',
            'price_from' => 'nullable|numeric|min:0',
            'price_to' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|integer|exists:categories,id',
            'in_stock' => 'nullable|boolean',
            'rating_from' => 'nullable|numeric|min:0|max:5',
            'sort' => 'nullable|in:price_asc,price_desc,rating_asc,rating_desc,newest',
        ];
    }

    public function messages()
    {
        return [
            'price_from.numeric' => 'Минимальная цена должна быть числом',
            'price_to.numeric' => 'Максимальная цена должна быть числом',
            'category_id.exists' => 'Выбранная категория не существует',
            'rating_from.numeric' => 'Рейтинг должен быть числом',
            'rating_from.max' => 'Рейтинг не может быть больше 5',
        ];
    }
}
