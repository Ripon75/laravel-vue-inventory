<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'brand_id',
        'name',
        'sku',
        'image',
        'cost_price',
        'retail_price',
        'year',
        'description'
    ];

    protected $casts = [
        'id'   => 'integer',
        'name' => 'string'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function productStock()
    {
        return $this->hasMany(ProductSizeStock::class, 'product_id', 'id');
    }
}
