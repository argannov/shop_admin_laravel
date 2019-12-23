<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promocods;
use App\Goods;
use Carbon\Carbon;

class NewPromocodeController extends Controller
{
    public function index(){

        $promo = Promocods::all();
        $count = 0;
        foreach ($promo as $itemPromo){
            $count = $count + 1;
        }
        return view("admin.promo.index",['promo'=>$promo,'count'=>$count]);
    }
    public function create(){
        $goods = Goods::all();
        return view('admin.promo.createpromo',['goods'=>$goods]);
    }
    public function createPromo(Request $request){
        $promo = new Promocods();
        $promo->discount_name = $request->namepromo;
        $promo->coupon = $request->codepromo;
        $promo->size_promo=$request->sizepromo;
        $promo->date_apply = $request->promocodedate;
        $promo->goods_items =$request->goodspromo;
        $promo->active=$request->statusgoods;
        $promo->created_at = Carbon::now();
        $promo->updated_at = Carbon::now();
        $promo->save();
        return redirect('/admin/sale/');
    }
    public function edit($slug){
        $promo = Promocods::where('id','=',$slug)->first();
        $goods = Goods::all();
        $promo->date_apply = Carbon::parse($promo->date_apply)->format('Y-m-d\TH:i');
        return view('admin.promo.editpromo',['promo'=>$promo,'goods'=>$goods]);
    }
    public function editSend($slug, Request $request){

        $promo = Promocods::where('id','=',$slug)->first();
        $promo->discount_name = $request->namepromo;
        $promo->coupon = $request->codepromo;
        $promo->size_promo=$request->sizepromo;
        $promo->date_apply = $request->promocodedate;
        $goods =$request->goodspromo;

        $goodsItem = array();
        $intArr = 0;
        foreach ($goods as $intArr => $goodsItemArrDate) {
            $goodsItem[$intArr] = $goodsItemArrDate;
            $intArr++;
        }
        //dd($goodsItem);
        $encode = json_encode($goodsItem);
        $promo->goods_items = $encode;

        $promo->active=$request->statusgoods;
        $promo->updated_at = Carbon::now();
        $promo->save();
        return redirect('/admin/sale/');
    }
    public function deletePromo($slug){
        $promo = Promocods::where('id','=',$slug)->first();
        $promo->delete();
        return redirect('/admin/sale/');
    }
}
