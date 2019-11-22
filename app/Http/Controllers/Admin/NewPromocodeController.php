<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewPromocodeController extends Controller
{
    function index(){
        return view("admin.promo.index");
    }
    function create(){
        return view('admin.promo.createpromo');
    }
}
