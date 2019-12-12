<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Goods;

class NewGoodsController extends Controller
{
    //
    function index(){
        return view('admin.product.allProduct');
    }
    function formProduct(){
        return view('admin.product.createProduct');
    }
    public function addProduct(Request $request){
        $goods = new Goods();
        $goods->title = $request->namegoods;
        $goods->slug = $request->sluggoods;
        $goods->article = $request->articulegoods;
        $goods->image_anons = $request->imageanons;
        $goods->meta_keywords = $request->seokeywordgoods;
        $goods->meta_description = $request->seodescriptiongoods;
        $goods->price = $request->pricegoods;
        $goods->old_price = null;
        $goods->sale = null;
        $goods->image_anons = $request->imageanons;
        $goods->image_detail = $request->imagedetail;
        $goods->status = $request->statusgoods;
        $goods->body = $request->body;
        $goods->category = $request->categorygoods;
        $goods->save();
        return redirect('/admin/product');
    }
}
