<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use APP\Http\Resources\CommentUser as CommentUserResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    // Registered Policies
    protected $policies = [
        'App\Comment' => 'App\Policies\CommentPolicy'
    ];


    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Data could be dispalt using the data[] as an key, as we can define own or without wraping key, so we use withoutWrapping
        JsonResource::withoutWrapping();


        // JsonResource::withoutWrapping();
        // Use for own badge
        Blade::component('components.badge', 'badge');
    }
}
