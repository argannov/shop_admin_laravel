<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewStoreRequest;
use App\Http\Controllers\Controller;
use App\Services\Repository\Interfaces\Repository;
use App\Stores;

class NewStoreController extends Controller
{
    /** @var Repository */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('admin.store.index', ['stores' => $this->repository->all()]);
    }

    public function show($slug) {
        return view('admin.store.detailstore', ['store' => $this->repository->get($slug)]);
    }

    /**
     * @param NewStoreRequest $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(NewStoreRequest $request)
    {
        if ($request->isMethod('GET')) {
            return view('admin.store.createstore');
        }

        try {
            $this->repository->create($request);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return view('admin.store.createstore');
    }

    /**
     * @param NewStoreRequest $request
     * @param $slug int
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(NewStoreRequest $request, $slug)
    {
        /** @var Stores $store */
        $store = $this->repository->get($slug);

        if ($request->isMethod('GET')) {
            return view('admin.store.createstore', ['store' => $store]);
        }

        try {
            $this->repository->update($store, $request);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return view('admin.store.createstore', ['store' => $store]);
    }

    public function delete($slug)
    {
        /** @var Stores $store */
        $store = $this->repository->get($slug);

        try {
            $this->repository->delete($store);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return view('admin.store.index', ['stores' => $this->repository->all()]);
    }
}
