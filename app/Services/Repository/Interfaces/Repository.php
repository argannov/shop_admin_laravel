<?php

namespace App\Services\Repository\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface Repository
{
    public function get($slug);

    public function all();

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
