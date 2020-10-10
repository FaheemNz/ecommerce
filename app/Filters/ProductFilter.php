<?php

namespace App\Filters;

class ProductFilter extends Filters
{
    protected $filters = ['category', 'sort'];

    public function category(string $slug)
    {
        return $this->builder
            ->with('categories')
            ->whereHas('categories', fn ($query) => $query->where('slug', $slug))
            ->get();
    }

    public function sort(string $sortType)
    {
        return $sortType === 'low'
            ? $this->builder->orderBy('price')
            : $this->builder->orderBy('price', 'DESC');
    }
}
