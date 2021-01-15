<?php

namespace App\Models;

use App\Filters\ProductFilter;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected const MIN_RATING = 1;
    protected const MAX_RATING = 5;

    // Logic
    public function addComment($request)
    {
        if ($request['rating'] < self::MIN_RATING || $request['rating'] > self::MAX_RATING) {
            throw new \InvalidArgumentException("Invalid Rating Given");
        }
        
        $this->comments()->create([
            'body' => $request['body'],
            'user_id' => auth()->id(),
            'rating' => $request['rating']
        ]);
    }

    public function getFeaturedProducts(int $limit = 4)
    {
        return Product::where('is_featured', true)->take($limit)->get();
    }

    public function getRating()
    {
        return number_format($this->comments->avg('rating'), 1);
    }

    // Relationships
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    // Accessors
    // public function getImageAttribute($value)
    // {
    //     return file_exists('storage/' . $value) ? asset('storage/' . $value) : asset('img/' . $value);
    // }
    public function getFormattedPriceAttribute()
    {
        return presentPrice($this->price);
    }

    // Scopes
    public function scopeFilter($query, ProductFilter $productFilter)
    {
        return $productFilter->apply($query);
    }
}
