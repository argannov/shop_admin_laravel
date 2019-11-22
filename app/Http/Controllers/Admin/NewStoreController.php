<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewStoreController extends Controller
{
    function index(){
        return view('admin.store.index');
    }
    function create(){
        return view('admin.store.createstore');
    }
}
