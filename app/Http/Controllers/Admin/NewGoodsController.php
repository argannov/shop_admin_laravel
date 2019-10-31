<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewGoodsController extends Controller
{
    //
    function index(){
        return view('admin.product.allProduct');
    }
    function formProduct(){
        return view('admin.product.createProduct');
    }
}
