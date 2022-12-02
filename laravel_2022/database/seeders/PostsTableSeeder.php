<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'title' => 'Post 1',
                'excerpt' => 'Summary of post 1',
                'body'=> 'Body of post 1',
                'image_path'=> 'Empty',
                'is_published'=> false,
                'min_to_read' => 2,

            ],

            [
                'title' => 'Post 2',
                'excerpt' => 'Summary of post 2',
                'body'=> 'Body of post 2',
                'image_path'=> 'Empty',
                'is_published'=> false,
                'min_to_read' => 2,

            ],
        ];

        foreach($posts as $key => $value){
            Post::create($value);
        }
    }
}
