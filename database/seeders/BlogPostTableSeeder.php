<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use App\Models\User;
class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // using make and each becasue of foreign key and didnt enter foreign column
        //Put dynamic data using seeding
        $blogCount = (int)$this->command->ask('How many blog posts would you like?', 50);
        $users = \App\Models\User::all();
        \App\Models\BlogPost::factory($blogCount)->make()->each(function($post) use($users){
            $post->user_id = $users->random()->id;
            $post->save();
        });
    }
}
