<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15.01.2020
 * Time: 14:43
 */

namespace App\Services\Repository;


use App\Services\Repository\Interfaces\Repository;
use App\Stores;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class StoresRepository implements Repository
{

    public function get($slug)
    {
        return Stores::where('slug', '=', $slug)->first();
    }

    public function all()
    {
        return Stores::all();
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function create(Request $request): bool
    {
        /** @var Stores $store */
        $store = Stores::create($request->post());

        try {
            $this->uploadImage($store, $request);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return $store->save();
    }

    /**
     * @param $model Stores
     * @return bool
     */
    public function update($model, Request $request): bool
    {
        $model->fill($request->post());

        try {
            $this->uploadImage($model, $request);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return $model->save();
    }

    /**
     * @param $model Stores
     * @return bool
     * @throws \Throwable
     */
    public function delete($model): bool
    {
        return (bool) $model->delete();
    }

    /**
     * @param $store
     * @param Request $request
     */
    private function uploadImage($store, Request $request) {
        if ($request->hasFile('image')) {
            /** @var UploadedFile $file */
            $file = $request->file('image');
            $uploaded = $file->store('stores/img', 'public');
            if ($uploaded !== false) {
                $store->image = $uploaded;
            }
        }
    }
}
