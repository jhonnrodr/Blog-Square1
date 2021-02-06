<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

/**
 * Class EloquentProjectRepository.
 *
 * @property Post $model
 *
 */
class PostRepository implements PostRepositoryInterface
{
    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
    }
    /**
     * {@inheritdoc}
     */
    public function getAll($order)
    {
        return $this->model::query()
                ->select('id', 'title', 'description', 'user_id', 'publication_date', 'slug')
                ->with('author:id,name')
                ->orderBy('publication_date', $order)
                ->paginate(10);
    }

    public function getByAuthor(User $user)
    {
        return $user->posts()
                    ->select('id', 'title', 'description', 'publication_date')
                    ->orderBy('publication_date', 'desc')
                    ->paginate(10);
    }

    /**
    * {@inheritdoc}
    */
    public function createPost(int $userId, array $params)
    {
        return $this->model->create([
            'user_id' => $userId,
            'title' => Arr::get($params, 'title'),
            'description' => Arr::get($params, 'description'),
            'slug'  => Str::slug(Arr::get($params, 'title'), "-") .'-'. random_int(2, 1000),
            'publication_date' => Arr::get($params, 'publication_date')
        ]);
    }

    /**
    * {@inheritdoc}
    */
    public function find($id)
    {
        if (null == $post = $this->model->findOrFail($id)) {
            throw new ModelNotFoundException("Post not found");
        }

        return $post;
    }

    /**
    * {@inheritdoc}
    */
    public function findBySlug($slug)
    {
        if (null == $post = $this->model->newQuery()
            ->select('id', 'title', 'description', 'publication_date', 'user_id')
            ->with('author:id,name')
            ->where('slug', $slug)
            ->first()) {
            throw new ModelNotFoundException("Post not found");
        }
        return $post;
    }
}
