<?php

namespace App\Providers;

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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Make gate for specific user, that can edit the post that he posted. Now afte that go to controller
        Gate::define('update-post', function($user, $post){
            return $user->id == $post->user_id;
        });

        // For deletion authorization
        Gate::define('delete-post', function($user, $post){
            return $user->id == $post->user_id;
        });

        // Gate is for admin that run before above Gate define
        Gate::before(function($user, $ability){
            // we can even make it default and not set ability then they will do update & del access
            // If we make ability after && then it's abable to do any single task like we remove this admin to only edit (update-post)
            if($user->is_admin && in_array($ability, ['update-post', 'delete-post'])){
                return true;
            }
        });
    }
}
