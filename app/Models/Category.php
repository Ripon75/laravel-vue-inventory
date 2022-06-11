<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $casts = [
        'id'         => 'integer',
        'name'       => 'string',
        'slug'       => 'string',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];

    
    // append attribute
    protected $appends = ['text'];

    protected function text(): Attribute
    {
        return new Attribute(
            get: fn () => $this->name,
        );
    }
}
