<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\QueryBuilders\ProductQueryBuilder;
use App\Http\Requests\ProductsSearchRequest;

class ProductsController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('products.index', compact('categories'));
    }

    public function api(ProductsSearchRequest $request)
    {
        $criteria = $request->validated();
        $query = (new ProductQueryBuilder)->build($criteria);
        $products = $query->paginate(20);

        return response()->json($products);
    }
}
