<?php

namespace App\Providers;

use App\Models\Comment;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Comment' => 'App\Policies\ProductCommentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('add-review', function ($user, $comments) {
            $alreadyCommented = false;

            foreach ($comments->toArray() as $comment) {
                if ($comment['user_id'] == $user->id) {
                    $alreadyCommented = true;
                    break;
                }
            }

            return !$alreadyCommented;
        });
    }
}
