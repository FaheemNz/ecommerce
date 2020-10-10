<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $with = 'user:id,name';
    protected $guarded = [];
    
    // public static function boot()
    // {
    //     parent::boot();
    //     static::deleting(fn($comment) => $comment);
    // }
    
    // Relationships
    public function commentable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function ratings()
    {
        return $this->morphMany('App\Models\Rating', 'ratingable');
    }

    // Accessors
    public function getCreatedAtAttribute($time)
    {
        return Carbon::parse($time)->diffForHumans();
    }
}
