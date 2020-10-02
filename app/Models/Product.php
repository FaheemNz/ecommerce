<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Logic
    public function getRandomProducts(int $limit = 5, $where = null)
    {
        $products = Product::query();
        if ($where) $products->where($where[0], $where[1] ?? '=', $where[2]);
        return $products->inRandomOrder()->take($limit)->get();
    }

    public function getFormattedPriceAttribute()
    {
        return presentPrice($this->price);
    }

    // Relationships
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    // Accessors
    public function getImageAttribute($value)
    {
        return asset('img/' . $value);
    }
}
