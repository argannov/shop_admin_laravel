<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewPostController extends Controller
{
    function index(){
        return view("admin.posts.index");
    }
    function create(){
        return view("admin.posts.createposts");
    }
}
