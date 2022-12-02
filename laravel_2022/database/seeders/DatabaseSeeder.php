<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(PostsTableSeeder::class); //this calls the PostTableSeeder class to so as to be seeded to a database.
        Post::factory(100)->create([
            // 'body'=> 'Overidig the body', //overiding certain fields(optional!)
        ]); //creates facory data

    }
}
