<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $users = \App\Models\User::factory(10)->create();
        $categories = \App\Models\Category::factory(25)->create();
        $tags = \App\Models\Tag::factory(100)->create();
        $posts = \App\Models\Post::factory(100)->make()->each(function ($order) use ($users, $categories){
             $order->user_id = $users->random()->id;
             $order->category_id = $categories->random()->id;
             $order->save();
         });
        \App\Models\PostTag::factory(100)->make()->each(function ($order) use ($posts, $tags){
            $order->post_id = $posts->random()->id;
            $order->tag_id = $tags->random()->id;
            $order->save();
        });
    }
}
