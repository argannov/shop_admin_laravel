<?php

namespace App\Http\Controllers\Admin;

use App\Services\FiltrationKeeper\Interfaces\FiltrationKeeper;
use App\Services\Repository\Interfaces\Repository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Goods;

class NewGoodsController extends Controller
{
    /** @var Repository */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    function index(FiltrationKeeper $filtrationKeeper)
    {

        $settings = [
            'filter' => [
                'params' => $filtrationKeeper->getParams(Goods::class)
            ],
            'columns' => [
                [
                    'title' => 'ID',
                ],
                [
                    'title' => 'Название',
                    'field' => [
                        'component' => 'text-field',
                        'name' => 'title',
                        'type' => 'text'
                    ]
                ],
                [
                    'title' => 'Дата изменения',
                    'field' => [
                        'component' => 'datetime-range',
                        'name' => 'updated_at',
                    ]
                ],
                [
                    'title' => 'Активность',
                    'field' => [
                        'component' => 'data-filter-select',
                        'name' => 'status',
                        'elements' => [
                            'published' => 'Опубликовано',
                            'draft' => 'Черновик'
                        ]
                    ]
                ],
                [
                    'title' => 'Цена',
                    'field' => [
                        'component' => 'text-field',
                        'name' => 'price',
                        'type' => 'number'
                    ]
                ],
                [
                    'title' => 'Удалить'
                ],
            ]
        ];

        return view('admin.product.allProduct', ['settings' => json_encode($settings)]);
    }

    function formProduct()
    {
        return view('admin.product.createProduct');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function all(Request $request)
    {
        $goods = $this->repository->all($request);
        return ['goods' => $goods, 'count' => $goods->count()];
    }

    public function create(Request $request)
    {
        try {
            $this->repository->create($request);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }
        return view('admin.product.createProduct');
    }

    public function update(Request $request, $slug)
    {
        $good = Goods::where('id', '=', $slug)->first();

        if ($request->isMethod('GET')) {
            return view('admin.product.editProduct', ['good' => $good]);
        }

        try {
            $this->repository->update($good, $request);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return view('admin.product.editProduct', ['good' => $good]);
    }

    public function delete($slug)
    {
        /** @var Goods $good */
        $good = $this->repository->get($slug);

        try {
            $this->repository->delete($good);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return $this->index();
    }
}
