<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface RepositoryInterface.
 *
 */
interface RepositoryInterface
{
    /**
     * Return all values.
     *
     * @return \App\Models\Post[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll($query);

    /**
     * Search Post by Id
     *
     * @param array $params
     *
     * @return \Illuminate\Support\Collection
     */
    public function find($id);
}
