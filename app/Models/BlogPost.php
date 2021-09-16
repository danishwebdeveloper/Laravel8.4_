<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    // Created bcz we use it in the Post Controller and we can't define all these things at BlogPost Resource Controller..!!!
    protected $fillable = [
        'title',
        'content',
        // 'user_id'
    ];
    
    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // this function is only made to perfectly delete bcz of foreign key and has relation with some other tables
    // So due to that it won;t possible to delete that event without this function bcz of foreign key relation.
    public static function boot(){
        parent::boot();
        static::deleting(function(BlogPost $blogPost){
            $blogPost->comment()->delete();
        });
    }


    // For most commented post, using Local query builder , and comment_count is prebuilt if you just use withCount
    public function scopemostCommented(Builder $query){
        return $query->withCount('comment')->orderBy('comment_count', 'desc');
    }




    
} 
