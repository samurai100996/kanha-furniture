<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'discount',
        'image',
        'category_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getDiscountedPriceAttribute()
    {
        return $this->price - ($this->price * $this->discount / 100);
    }

    public function hasDiscount()
    {
        return $this->discount > 0;
    }
}
