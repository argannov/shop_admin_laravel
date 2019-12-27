<?php

namespace App\Http\Controllers;

use App\Orders;
use Illuminate\Http\Request;
use App\Carts;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Bonus;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = $request->user_info;
        if($user_id == Auth::id()) {
            $product_list = array();
            $delivery = 300;
            $sum = 0;
            $sum = $sum + $delivery;
            $cart_arr = Carts::where('user_id', $user_id)->get();
            //dd($cart_arr);
            foreach ($cart_arr as $itemCart){
                $product_list[] = $itemCart->product_id;
                $sum = $sum + ($itemCart->price*$itemCart->quantity);
            }
            return view('client-part.order.indexOrder',['sum'=>$sum,'delivery'=>$delivery]);
        }
        else {
            return redirect('/cart');
        }
    }

    public function success(Request $request)
    {
        $order = new Orders();
        $order->name = $request->name_user;
        $order->surname = $request->fio_user;
        $order->last_name = $request->lastname_user;
        $order->phone = $request->phone_user;
        $order->delivery_name = $request->delivery;
        $order->pay_name = $request->pay;
        $order->user_id = Auth::id();
        $order->payed = 'N';
        $order->date_payed = null;
        $order->price_delivery = 300;
        $order->price = $request->price_order;
        $order->canceled = 'N';
        $order->date_canceled = null;
        $order->updated_at = Carbon::now();
        $order->created_at = Carbon::now();
        $cart_arr = Carts::where('user_id', Auth::id())->get();
        foreach ($cart_arr as $itemCart){
            $product_list[] = $itemCart->product_id;
        }
        $product_list = json_encode($product_list);
        $order->product_list = $product_list;
        $order->currency = 'RUB';
        $order->street = $request->street;
        $order->house = $request->house;
        $order->kvoroffice = $request->numberkv;
        $order->save();

        $allOrder = Orders::select('price')->where('user_id',Auth::id())->get();
        $summ = 0;
        foreach ($allOrder as $itemOrder){
            $summ = $itemOrder->price + $summ;
        }

        $bonuses = Bonus::where('id_users',Auth::id())->first();
        if(!$bonuses)
        {
            $bonuses = new Bonus();
            $bonuses->id_users = Auth::id();
            $bonuses->val_bonus = ($summ/100)*5;
            $bonuses->active = 'Y';
            $bonuses->updated_at = Carbon::now();
            $bonuses->created_at = Carbon::now();
            $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $number_card = substr(str_shuffle($permitted_chars), 0, 10);
            $bonuses->card_number = $number_card;
            $bonuses->save();
        }
        else {
            $summaBallov = $bonuses->val_bonus;
            $bonuses->val_bonus = ($request->price_order/100)*5 + $summaBallov;
            $bonuses->save();
        }

        Carts::where('user_id',Auth::id())->delete();
        return redirect('/order/success');
    }

    public function successOrder()
    {
        return redirect('/personal/orders')->with('status','Заказ офомрлен!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
