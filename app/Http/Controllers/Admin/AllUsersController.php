<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AllUsersController extends Controller
{
    function index(){
        $users = User::all();
        $count = 0;
        foreach ($users as $user){
            $count = $count + 1;
        }
        return view('admin.users.index',['users'=>$users,'count'=>$count]);
    }
}
