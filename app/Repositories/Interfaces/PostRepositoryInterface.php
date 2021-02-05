<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface PostRepository.
 *
 * @method Post findBySlug($id)
 */
interface PostRepositoryInterface extends RepositoryInterface
{
    /**
     *return all post.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll($query);

    /**
     * Create a Post
     *
     * @param collection $params
     *
     * @return \Illuminate\Support\Collection
     */
    public function createPost(int $userId, array $params);

    /**
     * Search Post by Slug
     *
     * @param string $slug
     *
     * @return \Illuminate\Support\Collection
     */
    public function findBySlug($slug);

    /**
     * Get Posts by Author
     *
     * @return \Illuminate\Support\Collection
     */
    public function getByAuthor(User $user);
}
