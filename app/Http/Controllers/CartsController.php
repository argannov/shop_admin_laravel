<?php

namespace App\Http\Controllers;

use App\Carts;
use App\Goods;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check() === false) {
            if (!empty(Cookie::get('product')) && !empty(Cookie::get('price'))) {
                $product = Cookie::get('product');
                $price = Cookie::get('price');
                $good = Goods::where('id', $product)->get();
                return view('client-part.cart.indexCart',['good'=>$good]);
            } else {
                return view('client-part.cart.indexCart');
            }
        } else {
            $id_user = Auth::id();
            $cart = Carts::where('user_id', '=', $id_user)->get();
            if(count($cart) != 0) {
                foreach ($cart as $item) {
                    $product_id = $item->product_id;
                    $good[] = Goods::where('id', $product_id)->get();
                }
                return view('client-part.cart.indexCart', ['cart' => $cart, 'good' => $good]);
            }
            else {
                return view('client-part.cart.indexCart');
            }

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        if (Auth::check() == true) {
            $emptyCarts = Carts::where('user_id', $request->user_info)->get();
            if (empty($emptyCarts->user_id)) {
                $cart = new Carts();
                $cart->user_id = $request->user_info;
                $cart->product_id = $request->product_info;
                $cart->price = $request->price;
                $cart->currency = 'RUB';
                $cart->weight = 1;
                $cart->quantity = 1;
                $cart->can_buy = 'Y';
                $cart->discount_coupon = null;
                $cart->reserved = 'Y';
                $cart->updated_at = Carbon::now();
                $cart->created_at = Carbon::now();
                $cart->save();
            } elseif ($emptyCarts->user_id == Auth::id() && $emptyCarts->product_id == $request->product_info) {
                $cart = Carts::where('user_id', Auth::id());
                $sum = $cart->price + $request->price;
                $cart->price = $sum;
                $cart->quantity = $cart->quantity++;
                $cart->save();
            }
        } else {
            if (empty(Cookie::get('product')) && empty(Cookie::get('price'))) {
                Cookie::queue(Cookie::make('product', $request->product_info, 60));
                Cookie::queue(Cookie::make('price', $request->price, 60));
            } elseif (!empty(Cookie::get('product')) && !empty(Cookie::get('price'))) {
                Cookie::queue(Cookie::make('product', $request->product_info, 60));
                Cookie::queue(Cookie::make('price', $request->price, 60));
            }
        }

        return redirect('/cart');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Carts $carts
     * @return \Illuminate\Http\Response
     */
    public function show(Carts $carts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Carts $carts
     * @return \Illuminate\Http\Response
     */
    public function edit(Carts $carts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Carts $carts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carts $carts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Carts $carts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carts $carts)
    {
        //
    }
}
