<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size_id',
        'location',
        'quantity',
    ];

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
}
