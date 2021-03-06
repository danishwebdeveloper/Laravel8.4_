<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $fillable = [
        'path',
        'blog_post_id',
    ];

    public function blogPost(){
        return $this->belongsTo(BlogPost::class);
    }
}
