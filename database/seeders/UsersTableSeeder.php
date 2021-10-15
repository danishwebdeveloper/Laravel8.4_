<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Here I enter record manually in a single field

        // $manual = DB::table('users')->insert([
        //     'name' => "manually add Name Danish",
        //     'email' => "manualemail@gmail.com",
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);

         // using model and create dummy data using Model Seeder
        \App\Models\User::factory(10)->create();
    }
}
