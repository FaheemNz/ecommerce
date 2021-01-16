<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $table = 'orders';
    protected $guarded = [];
    
    // Relationships
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('quantity');
    }
}
