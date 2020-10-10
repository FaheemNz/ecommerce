<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCommentPolicy
{
    use HandlesAuthorization;
    
    public function update(User $user, Comment $comment)
    {
        return $comment->user_id == $user->id;
    }
}
