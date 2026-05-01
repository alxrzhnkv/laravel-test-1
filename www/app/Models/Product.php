<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'category_id', 'in_stock', 'rating'];

    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
