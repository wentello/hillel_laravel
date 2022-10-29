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
        $posts = \App\Models\Post::factory(100)->make()->each(function ($post) use ($users, $categories) {
            $post->user_id = $users->random()->id;
            $post->category_id = $categories->random()->id;
            $post->save();
        });

        $posts->each(function ($order) use ($tags) {
            $order->tags()->attach($tags->random(rand(1, 5))->pluck('id'));
        });

        $categories->each(function ($post) use ($users, $categories, $posts) {
            $post_type = str(['App\Models\User','App\Models\Category'][array_rand(['App\Models\User','App\Models\Category'])]);
            $postable_id = ($post_type == 'App\Models\Category' ? $categories->random()->id : $users->random()->id);
            $post->postable()->attach($posts->random()->id, ['postable_type'=>$post_type, 'postable_id'=>$postable_id]);
        });

    }
}
