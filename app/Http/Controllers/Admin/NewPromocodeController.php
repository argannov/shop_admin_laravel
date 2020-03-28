<?php

namespace App\Http\Controllers\Admin;

use App\Services\FiltrationKeeper\Interfaces\FiltrationKeeper;
use App\Services\Repository\Interfaces\Repository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promocods;
use App\Goods;

class NewPromocodeController extends Controller
{
    /** @var Repository */
    private $repository;

    /** @var FiltrationKeeper */
    private $filtrationKeeper;

    public function __construct(Repository $repository, FiltrationKeeper $filtrationKeeper)
    {
        $this->repository = $repository;
        $this->filtrationKeeper = $filtrationKeeper;
    }

    public function index()
    {
        $params = $this->filtrationKeeper->getParams(Promocods::class);
        $settings = [
            'filter' => [
                'params' => $params
            ],
            'columns' => [
                'id' => [
                    'title' => 'ID'
                ],
                'discount_name' => [
                    'title' => 'Название',
                    'field' => [
                        'component' => 'text-field',
                        'name' => 'discount_name',
                        'type' => 'text',
                        'value' => $params['discount_name'] ?? null
                    ]
                ],
                'coupon' => [
                    'title' => 'Код',
                    'field' => [
                        'component' => 'text-field',
                        'name' => 'coupon',
                        'type' => 'text',
                        'value' => $params['coupon'] ?? null
                    ]
                ],
                'size_promo' => [
                    'title' => 'Размер скидки',
                    'field' => [
                        'component' => 'text-field',
                        'name' => 'size_promo',
                        'type' => 'number',
                        'value' => $params['size_promo'] ?? null
                    ]
                ],
                'date_apply' => [
                    'title' => 'Дата окончания скидки',
                    'field' => [
                        'component' => 'datetime-range',
                        'name' => 'date_apply',
                        'value' => $params['date_apply'] ?? null
                    ]
                ],
                'status' => [
                    'title' => 'Статус',
                    'criteria' => [
                        'published' => 'label-success',
                        'draft' => 'label-warning'
                    ],
                    'field' => [
                        'component' => 'data-filter-select',
                        'name' => 'active',
                        'elements' => [
                            'published' => 'Активна',
                            'draft' => 'Неактивна'
                        ],
                        'value' => $params['active'] ?? null
                    ]
                ]
            ],
            'actions' => [
                'delete' => [
                    'title' => 'Удалить'
                ]
            ]
        ];
        return view("admin.promo.index", ['settings' => json_encode($settings)]);
    }

    public function all(Request $request)
    {
        $promos = $this->repository->all($request);
        return ['elements' => $promos, 'count' => $promos->count()];
    }

    public function create(Request $request)
    {
        $goods = Goods::all();
        if ($request->isMethod('GET')) {
            return view('admin.promo.createpromo', ['goods' => $goods]);
        }

        try {
            $this->repository->create($request);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return view('admin.promo.createpromo', ['goods' => $goods]);
    }

    public function edit(Request $request, $slug)
    {
        $goods = Goods::all();
        /** @var Promocods $promo */
        $promo = $this->repository->get($slug);

        if ($request->isMethod('GET')) {
            return view('admin.promo.editpromo', ['promo' => $promo, 'goods' => $goods]);
        }

        try {
            $this->repository->update($promo, $request);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }
//        $promo->date_apply = Carbon::parse($promo->date_apply)->format('Y-m-d\TH:i');

        return view('admin.promo.editpromo', ['promo' => $promo, 'goods' => $goods]);
    }

    public function delete($slug)
    {
        $promo = $this->repository->get($slug);

        try {
            $this->repository->delete($promo);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return $this->index();
    }
}
