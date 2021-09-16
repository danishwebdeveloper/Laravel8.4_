<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function blogposts(){
        return $this->hasMany(BlogPost::class);
    }

    
    // For Most counted Person that comments & Posts (User fetch with blogposts function(relation) with BlogPosts)
    // Alos use TINKER to verify about the fucntion WithMostBlogPosts, User::WithMostBlogPosts()->take(5)->get();
    public function scopeWithMostBlogPosts(Builder $query){
        return $query->withCount('blogposts')->orderBy('blogposts_count', 'desc');
    }

    // Most Active USers
    // public function scopeWithMostBlogPostsLastMonths(Builder $query){
    //     return $query->withCount(['blogposts' => function(Builder $query){
    //         $query->whereBetween('created_at', [now()->subMonths(1), now()]);
    //     }])->having('blogposts_count', '>=', 2)->orderBy('blogposts_count', 'DESC');
    // }

}
