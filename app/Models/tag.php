<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;

    // Many to Many Relation with BlogPosts
    public function blogposts(){
        $this->belongsToMany(BlogPost::class);
    }
}
