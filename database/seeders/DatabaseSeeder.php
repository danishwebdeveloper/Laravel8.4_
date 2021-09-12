<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeders\factory; 
use App\Models\User; 
use App\Models\BlogPost;  
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       

        // Here I enter record manually in a single field
        $manual = DB::table('users')->insert([
            'name' => "manually add Name Danish",
            'email' => "manualemail@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

         // using model and create dummy data using Model Seeder
        $users = \App\Models\User::factory(10)->create();
        
        // dd($users);

        // using make and each becasue of foreign key and didnt enter foreign column
        //Put dynamic data using seeding
        $posts = \App\Models\BlogPost::factory(20)->make()->each(function($post) use($users){
            $post->user_id = $users->random()->id;
            $post->save();
        });

        $comments = \App\Models\Comment::factory(50)->make()->each(function($comment) use ($posts){
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });
        
    
    }
}
