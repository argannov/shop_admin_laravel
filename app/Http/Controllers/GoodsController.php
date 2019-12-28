<?php

namespace App\Http\Controllers;

use App\Goods;
use Illuminate\Http\Request;
use App\Promocods;
use Illuminate\Support\Facades\Auth;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods = Goods::all();
        $sales = Promocods::all();

        foreach ($sales as $sale) {
            $decode = json_decode($sale->goods_items);
            $discount_size = $sale->size_promo;
        }

        foreach ($goods as $good) {
            foreach ($decode as $item) {
                if ($good->id == $item) {
                    $price = $good->price;
                    $good->price = $price - ($price / 100) * $discount_size;
                }
            }
        }
        if(Auth::check()){
            $user = Auth::id();
            return view('client-part.catalog.catalogIndex',['goods' => $goods,'user'=>$user]);
        }
        else {
            return view('client-part.catalog.catalogIndex',['goods' => $goods]);
        }
    }

    public function detailIndex($slug)
    {
        $goods = Goods::where('slug', '=', $slug)->first();
        $sales = Promocods::all();

        foreach ($sales as $sale) {
            $decode = json_decode($sale->goods_items);
            $discount_size = $sale->size_promo;
        }
        foreach ($decode as $item) {
            if ($goods->id == $item) {
                $price = $goods->price;
                $goods->price = $price - ($price / 100) * $discount_size;
            }
        }

        return view('client-part.catalog.detail', ['good' => $goods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Goods $goods
     * @return \Illuminate\Http\Response
     */
    public function show(Goods $goods)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Goods $goods
     * @return \Illuminate\Http\Response
     */
    public function edit(Goods $goods)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Goods $goods
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goods $goods)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Goods $goods
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goods $goods)
    {
        //
    }
}
