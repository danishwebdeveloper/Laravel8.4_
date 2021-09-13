<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = \App\Models\BlogPost::all();
        \App\Models\Comment::factory(50)->make()->each(function($comment) use ($posts){
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
