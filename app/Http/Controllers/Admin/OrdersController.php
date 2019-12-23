<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orders;

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
}
