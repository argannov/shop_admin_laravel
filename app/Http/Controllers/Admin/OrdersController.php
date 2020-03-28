<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrdersRequest;
use App\Services\FiltrationKeeper\Interfaces\FiltrationKeeper;
use App\Services\Repository\Interfaces\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orders;
use App\User;
use App\Goods;
use PDF;

class OrdersController extends Controller
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

    function index()
    {
        $params = $this->filtrationKeeper->getParams(Orders::class);

        $settings = [
            'filter' => [
                'params' => $params
            ],
            'columns' => [
                'id' => [
                    'title' => 'ID'
                ],
                'user.name' => [
                    'title' => 'Имя пользователя',
                    'field' => [
                        'component' => 'text-field',
                        'name' => 'name',
                        'type' => 'text',
                        'value' => $params['name'] ?? null
                    ]
                ],
                'user.email' => [
                    'title' => 'E-mail',
                    'field' => [
                        'component' => 'text-field',
                        'name' => 'email',
                        'type' => 'text',
                        'value' => $params['email'] ?? null
                    ]
                ],
                'delivery_name' => [
                    'title' => 'Курьер',
                    'field' => [
                        'component' => 'text-field',
                        'name' => 'delivery_name',
                        'type' => 'text',
                        'value' => $params['delivery_name'] ?? null
                    ]
                ],
                'price' => [
                    'title' => 'Стоимость',
                    'field' => [
                        'component' => 'text-field',
                        'name' => 'price',
                        'type' => 'number',
                        'value' => $params['price'] ?? null
                    ]
                ]
            ],
            'actions' => [
                'delete' => [
                    'title' => 'Удалить'
                ]
            ]
        ];

        return view('admin.order.index', ['settings' => json_encode($settings)]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function all(Request $request)
    {
        /** @var Collection $orders */
        $orders = $this->repository->all($request);
        return ['elements' => $orders, 'count' => $orders->count()];
    }

    /**
     * @param OrdersRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(OrdersRequest $request)
    {
        if ($request->isMethod('GET')) {
            return view('admin.order.create');
        }

        try {
            $this->repository->create($request);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return view('admin.order.create');
    }

    /**
     * @param OrdersRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(OrdersRequest $request, $id)
    {
        /** @var Orders $order */
        $order = $this->repository->get($id);

        if ($request->isMethod('GET')) {
            return view('admin.order.create', ['order' => $order]);
        }

        try {
            $this->repository->update($order, $request);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return view('admin.order.create', ['order' => $order]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $order = $this->repository->get($id);

        try {
            $this->repository->delete($order);
        } catch (\Throwable $e) {
            \Log::error($e->getMessage());
        }

        return $this->index();
    }
    public function oneOrder($slug) {
        $order = Orders::where('id',$slug)->first();
        $id = $order->id;
        $user_id = $order->user_id;
        $info_user = User::where('id',$user_id)->first();
        $ProductInfo = $order->product_list;
        $InfoProducts = Goods::whereIn('id',json_decode($ProductInfo,true))->get();
        return view('admin.order.DetailOrder', ['order'=>$order,'id'=>$id,'user_info'=>$info_user,'products'=>$InfoProducts]);
    }
    public function printPDF($slug)
    {
        $order = Orders::where('id',$slug)->first();
        $id = $order->id;
        $user_id = $order->user_id;
        $info_user = User::where('id',$user_id)->first();
        $ProductInfo = $order->product_list;
        $InfoProducts = Goods::whereIn('id',json_decode($ProductInfo,true))->get();

        $pdf = PDF::loadView('admin.order.printPDF',['order'=>$order,'id'=>$id,'user_info'=>$info_user,'products'=>$InfoProducts]);
        return $pdf->download('order'.$id.'.pdf');
    }
}
