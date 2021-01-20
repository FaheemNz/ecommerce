<?php

namespace App\Models;

use App\Jobs\ProductOrderEmailJob;
use Carbon\Carbon;
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

    // Methods
    public function sendOrderProcessedEmail()
    {
        $delay = Carbon::now()->addSeconds(5);
        $job = (new ProductOrderEmailJob($this))->delay($delay);
        
        dispatch($job);
    }
}
