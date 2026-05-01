<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class ProductQueryBuilder
{
    public function build(array $criteria): Builder
    {
        $query = Product::query()->with('category');

        if (!empty($criteria['q'])) {
            $query->where('name', 'like', '%'.$criteria['q'].'%');
        }

        if (!empty($criteria['price_from'])) {
            $query->where('price', '>=', $criteria['price_from']);
        }

        if (!empty($criteria['price_to'])) {
            $query->where('price', '<=', $criteria['price_to']);
        }

        if (!empty($criteria['category_id'])) {
            $query->where('category_id', $criteria['category_id']);
        }

        if (array_key_exists('in_stock', $criteria)) {
            $query->where('in_stock', (bool) $criteria['in_stock']);
        }

        if (!empty($criteria['rating_from'])) {
            $query->where('rating', '>=', $criteria['rating_from']);
        }

        $sort = $criteria['sort'] ?? null;

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating_asc':
                $query->orderBy('rating', 'asc');
                break;
            case 'rating_desc':
                $query->orderBy('rating', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('name', 'asc');
        }

        return $query;
    }
}
