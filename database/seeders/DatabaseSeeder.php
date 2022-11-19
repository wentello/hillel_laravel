<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Job;
use App\Models\Tag;
use App\Models\Post;
use function Ramsey\Uuid\Generator\timestamp;
use function Spatie\Ignition\ErrorPage\title;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(10)->create();
        $categories = Category::factory(25)->create();
        $tags = Tag::factory(100)->create();
        $posts = Post::factory(100)->make()->each(function ($post) use ($users, $categories) {
            $post->user_id = $users->random()->id;
            $post->category_id = $categories->random()->id;
            $post->save();
        });

        $posts->each(function ($order) use ($tags) {
            $order->tags()->attach($tags->random(rand(1, 5))->pluck('id'));
        });

        $categories->each(function ($post) use ($users, $categories, $posts) {
            $post_type = str([User::class, Category::class][array_rand([User::class, Category::class])]);
            $postable_id = ($post_type == Category::class ? $categories->random()->id : $users->random()->id);
            $post->postable()->attach($posts->random()->id, ['postable_type' => $post_type, 'postable_id' => $postable_id]);
        });

        $arrServer = [
            '{"uuid":"ee1f47c5-4aba-4316-afc5-edc8b16cdf00","displayName":"App\\\\Jobs\\\\SetAgentInfo","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\SetAgentInfo","command":"O:21:\"App\\\\Jobs\\\\SetAgentInfo\":2:{s:9:\"userAgent\";O:54:\"Hillel\\\\UserAgentJenssegers\\\\Test\\\\JenssegersAgentService\":1:{s:61:\"\u0000Hillel\\\\UserAgentJenssegers\\\\Test\\\\JenssegersAgentService\u0000agent\";O:22:\"Jenssegers\\\\Agent\\\\Agent\":7:{s:8:\"\u0000*\u0000cache\";a:0:{}s:12:\"\u0000*\u0000userAgent\";s:111:\"Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/106.0.0.0 Safari\/537.36\";s:14:\"\u0000*\u0000httpHeaders\";a:9:{s:11:\"HTTP_COOKIE\";s:713:\"XSRF-TOKEN=eyJpdiI6IjRJdStIanNEcDk0VmZJbTU0bEpqV1E9PSIsInZhbHVlIjoiZktDK2R6MFJlbEMyQlhOZTV0Q0d1eVRxbGZGUllhaFNjTnp5dkdBR3hzMmdiUExnZ0FSZk9zOGtwbGw4Q1piTHNZU0lhVSt2cEpRMmhTNm9xNG1PZWJJVkdmdE4vbE1XYzFZbWhGTEkwZG5UU3UvRm9rQ3NoSlV3WlJHK3BnMUEiLCJtYWMiOiIzOTJjODBjM2JiNTUwMDEwZTlkNzhmMDM3ZWEzYTE3NTZiMDA4ZGNhZTI4NWNiNWU0MDExNjkyNGZjOWRkNGZiIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IkhsL09JSTZZNXdQSkRTUVJ5cmMvQXc9PSIsInZhbHVlIjoiN3hzNHRGcnQ5ekZhMm5OenNXYlozdStqNHpLNmVwZit5ZnBrMmNKY1pXN2hmbWkwOXBqbUFtbWJtL1BXM3IveGh3ZmVlbmFXKzErMTVHazIzSTBlbHE2VWJyNFlqYVFBb2VOV0NLamdxMjA5MHlSUkhtZElEblB1dmozcUFzL0giLCJtYWMiOiI2ZmMzZTc4MmNjNWVmMzgyYjcyMjBkMzExZDQ5ZjcwZGUxOWJiYzZjNTYwNTAxM2UxNzljM2ZkNWIyYjY4MTk5IiwidGFnIjoiIn0%3D\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:32:\"en-US,en;q=0.9,he;q=0.8,ru;q=0.7\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:11:\"HTTP_ACCEPT\";s:135:\"text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/avif,image\/webp,image\/apng,*\/*;q=0.8,application\/signed-exchange;v=b3;q=0.9\";s:15:\"HTTP_USER_AGENT\";s:111:\"Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/106.0.0.0 Safari\/537.36\";s:30:\"HTTP_UPGRADE_INSECURE_REQUESTS\";s:1:\"1\";s:18:\"HTTP_CACHE_CONTROL\";s:9:\"max-age=0\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:9:\"HTTP_HOST\";s:21:\"hillel_laravel.dev.ua\";}s:20:\"\u0000*\u0000cloudfrontHeaders\";a:0:{}s:16:\"\u0000*\u0000matchingRegex\";N;s:15:\"\u0000*\u0000matchesArray\";N;s:16:\"\u0000*\u0000detectionType\";s:6:\"mobile\";}}s:5:\"queue\";s:7:\"parsing\";}"}}',
            '{"uuid":"c3f8bac4-b17c-47ad-b4a1-28376806f93c","displayName":"App\\\\Jobs\\\\SetAgentInfo","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\SetAgentInfo","command":"O:21:\"App\\\\Jobs\\\\SetAgentInfo\":2:{s:9:\"userAgent\";O:54:\"Hillel\\\\UserAgentJenssegers\\\\Test\\\\JenssegersAgentService\":1:{s:61:\"\u0000Hillel\\\\UserAgentJenssegers\\\\Test\\\\JenssegersAgentService\u0000agent\";O:22:\"Jenssegers\\\\Agent\\\\Agent\":7:{s:8:\"\u0000*\u0000cache\";a:0:{}s:12:\"\u0000*\u0000userAgent\";s:129:\"Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/107.0.0.0 Safari\/537.36 Edg\/107.0.1418.52\";s:14:\"\u0000*\u0000httpHeaders\";a:7:{s:20:\"HTTP_ACCEPT_LANGUAGE\";s:14:\"en-US,en;q=0.9\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:11:\"HTTP_ACCEPT\";s:124:\"text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,image\/apng,*\/*;q=0.8,application\/signed-exchange;v=b3;q=0.9\";s:15:\"HTTP_USER_AGENT\";s:129:\"Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/107.0.0.0 Safari\/537.36 Edg\/107.0.1418.52\";s:30:\"HTTP_UPGRADE_INSECURE_REQUESTS\";s:1:\"1\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:9:\"HTTP_HOST\";s:21:\"hillel_laravel.dev.ua\";}s:20:\"\u0000*\u0000cloudfrontHeaders\";a:0:{}s:16:\"\u0000*\u0000matchingRegex\";N;s:15:\"\u0000*\u0000matchesArray\";N;s:16:\"\u0000*\u0000detectionType\";s:6:\"mobile\";}}s:5:\"queue\";s:7:\"parsing\";}"}}',
            '{"uuid":"3a6b2685-0bf6-460a-a978-7f8baa365fa8","displayName":"App\\\\Jobs\\\\SetAgentInfo","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\SetAgentInfo","command":"O:21:\"App\\\\Jobs\\\\SetAgentInfo\":2:{s:9:\"userAgent\";O:54:\"Hillel\\\\UserAgentJenssegers\\\\Test\\\\JenssegersAgentService\":1:{s:61:\"\u0000Hillel\\\\UserAgentJenssegers\\\\Test\\\\JenssegersAgentService\u0000agent\";O:22:\"Jenssegers\\\\Agent\\\\Agent\":7:{s:8:\"\u0000*\u0000cache\";a:0:{}s:12:\"\u0000*\u0000userAgent\";s:69:\"Mozilla\/5.0 (Windows NT 10.0; WOW64; Trident\/7.0; rv:11.0) like Gecko\";s:14:\"\u0000*\u0000httpHeaders\";a:6:{s:15:\"HTTP_CONNECTION\";s:10:\"Keep-Alive\";s:9:\"HTTP_HOST\";s:21:\"hillel_laravel.dev.ua\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:15:\"HTTP_USER_AGENT\";s:69:\"Mozilla\/5.0 (Windows NT 10.0; WOW64; Trident\/7.0; rv:11.0) like Gecko\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:35:\"en-IL,en-US;q=0.8,en;q=0.5,he;q=0.3\";s:11:\"HTTP_ACCEPT\";s:48:\"text\/html, application\/xhtml+xml, image\/jxr, *\/*\";}s:20:\"\u0000*\u0000cloudfrontHeaders\";a:0:{}s:16:\"\u0000*\u0000matchingRegex\";N;s:15:\"\u0000*\u0000matchesArray\";N;s:16:\"\u0000*\u0000detectionType\";s:6:\"mobile\";}}s:5:\"queue\";s:7:\"parsing\";}"}}',
            '{"uuid":"63901030-6e9c-4261-a6ac-c780c27f70b6","displayName":"App\\\\Jobs\\\\SetAgentInfo","job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","maxTries":null,"maxExceptions":null,"failOnTimeout":false,"backoff":null,"timeout":null,"retryUntil":null,"data":{"commandName":"App\\\\Jobs\\\\SetAgentInfo","command":"O:21:\"App\\\\Jobs\\\\SetAgentInfo\":2:{s:9:\"userAgent\";O:54:\"Hillel\\\\UserAgentJenssegers\\\\Test\\\\JenssegersAgentService\":1:{s:61:\"\u0000Hillel\\\\UserAgentJenssegers\\\\Test\\\\JenssegersAgentService\u0000agent\";O:22:\"Jenssegers\\\\Agent\\\\Agent\":7:{s:8:\"\u0000*\u0000cache\";a:0:{}s:12:\"\u0000*\u0000userAgent\";s:80:\"Mozilla\/5.0 (Windows NT 10.0; Win64; x64; rv:107.0) Gecko\/20100101 Firefox\/107.0\";s:14:\"\u0000*\u0000httpHeaders\";a:7:{s:30:\"HTTP_UPGRADE_INSECURE_REQUESTS\";s:1:\"1\";s:15:\"HTTP_CONNECTION\";s:10:\"keep-alive\";s:20:\"HTTP_ACCEPT_ENCODING\";s:13:\"gzip, deflate\";s:20:\"HTTP_ACCEPT_LANGUAGE\";s:14:\"en-US,en;q=0.5\";s:11:\"HTTP_ACCEPT\";s:85:\"text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/avif,image\/webp,*\/*;q=0.8\";s:15:\"HTTP_USER_AGENT\";s:80:\"Mozilla\/5.0 (Windows NT 10.0; Win64; x64; rv:107.0) Gecko\/20100101 Firefox\/107.0\";s:9:\"HTTP_HOST\";s:21:\"hillel_laravel.dev.ua\";}s:20:\"\u0000*\u0000cloudfrontHeaders\";a:0:{}s:16:\"\u0000*\u0000matchingRegex\";N;s:15:\"\u0000*\u0000matchesArray\";N;s:16:\"\u0000*\u0000detectionType\";s:6:\"mobile\";}}s:5:\"queue\";s:7:\"parsing\";}"}}',
        ];

        Job::factory(20)->make()->each(function ($job) use ($arrServer) {
            $job->attempts = 0;
            $job->available_at = time();
            $job->created_at = time();
            $job->queue = 'parsing';
            $job->payload = $arrServer[rand(0, 3)];
            $job->save();
        });
    }
}
