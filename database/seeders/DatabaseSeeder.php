<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Seeders\factory; 
use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        
        $users = $this->call(
            [
                UsersTableSeeder::class, 
                BlogPostTableSeeder::class, 
                CommentTableSeeder::class,
            ]
        );     
    
    }
}
