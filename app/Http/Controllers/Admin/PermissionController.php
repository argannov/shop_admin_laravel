<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\User_roles;
use App\Roles;

class PermissionController extends Controller
{
    function index(){
        $users = User::all();
        $Roles = Roles::all();
        $user_roles = User_roles::all();
        return view('admin.users.permission', ['users'=>$users]);
    }
}
