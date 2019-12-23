<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use Illuminate\Support\Facades\Auth;
use App\User;

class LKController extends Controller
{
    public function index()
    {
        $user = User::where('id',Auth::id())->first();
        return view('client-part.personal.indexPersonal',['user'=>$user]);
    }

    public function listOrder()
    {
        $orders = Orders::where('user_id',Auth::id())->get();
        return view('client-part.personal.orders',['order'=>$orders]);
    }
}
