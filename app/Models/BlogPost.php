<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    // Created bcz we use it in the Post Controller and we can't define all these things at BlogPost Resource Controller..!!!
    protected $fillable = [
        'title',
        'content'
    ];
    
    public function comment(){
        return $this->hasMany(Comment::class);
    }
    
} 
