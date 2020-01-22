<?php

namespace App\Services\Repository\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface Repository
{
    /**
     * @param string $slug
     * @return mixed
     */
    public function get($slug);

    /**
     * @param Request|null $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(Request $request = null);

    /**
     * @param Request $request
     * @return bool
     */
    public function create(Request $request): bool;

    /**
     * @param $model Model
     * @return bool
     */
    public function update($model, Request $request): bool;

    /**
     * @param $model Model
     * @return bool
     */
    public function delete($model): bool;
}
