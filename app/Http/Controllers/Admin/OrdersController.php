<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orders;
use App\User;
use App\Goods;
use PDF;

class OrdersController extends Controller
{
    function index(){
        $orders = Orders::all();
        $count = 0;
        foreach ($orders as $order)
        {
            $count = $count+1;
        }
        return view('admin.order.allorders',['orders'=>$orders,'count'=>$count]);
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
