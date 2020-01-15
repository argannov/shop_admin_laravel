<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15.01.2020
 * Time: 14:38
 */

namespace App\Services\Repository\Interfaces;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface Repository
{
    public function get($slug);
    public function all();
    public function create(Request $request): bool;
    /** @param $model Model */
    public function update($model, Request $request): bool;
    /** @param $model Model */
    public function delete($model): bool;
}
