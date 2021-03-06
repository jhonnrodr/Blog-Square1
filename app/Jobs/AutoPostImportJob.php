<?php

namespace App\Jobs;

use Exception;
use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepository;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AutoPostImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\User
     */
    private $user;
    /**
     * @var string
     */
    private $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = User::adminUser();
        $this->url = config('blog.url');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle():void
    {
        try {
            $client = new Client();
            $response = $client->request('GET', $this->url, [
            'verify'  => false,
        ]);
            $posts = collect(json_decode($response->getBody())->data);
            $posts->map(function ($post) {
                app()->make(PostRepository::class)->createPost($this->user->id, [
                'title'           => $post->title,
                'description'     => $post->description,
                'publication_date' => $post->publication_date
            ]);
            });
        } catch (Exception $e) {
            Log::error('Error with the Blog API: '.config('blog.url'));
            Log::error($e);
        }
    }

    /**
     * The job failed to process.
     *
     * @param Exception $exception
     */
    public function failed(Exception $exception)
    {
        throw new \Exception("Error Processing the job", 1);
    }
}
