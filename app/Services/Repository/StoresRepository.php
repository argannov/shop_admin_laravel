<?php

namespace App\Services\Repository;

use App\Stores;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class StoresRepository extends BaseRepository
{
    /**
     * @inheritdoc
     */
    public function get($slug)
    {
        return Stores::where('slug', '=', $slug)->first();
    }

    /**
     * @inheritdoc
     */
    public function all(Request $request = null)
    {
        $builder = Stores::query();

        return $this->paginate($builder, $request->get('currentPage', 1));
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
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
     * @inheritdoc
     */
    public function delete($model): bool
    {
        return (bool)$model->delete();
    }

    /**
     * @inheritdoc
     */
    private function uploadImage($store, Request $request)
    {
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
