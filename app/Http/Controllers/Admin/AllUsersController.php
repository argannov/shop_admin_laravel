<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllUsersController extends Controller
{
    function index(){
        return view('admin.users.index');
    }
}
