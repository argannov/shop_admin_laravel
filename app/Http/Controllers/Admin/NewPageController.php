<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewPageController extends Controller
{
    function index(){
        return view("admin.pages.index");
    }
    function create(){
        return view("admin.pages.createpage");
    }
}
