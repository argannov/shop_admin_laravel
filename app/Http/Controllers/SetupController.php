<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pages;
use App\User;
use Hash;
use Illuminate\Support\Facades\Storage;

class SetupController extends Controller
{
    public function index()
    {
        if(count(Pages::all()) == 0 && count(User::all()) == 0){
            return view('setup');
        }
        else {
            return redirect('/login');
        }
    }
    public function install(Request $request){
        $user = new User();
        $user->name = 'admin';
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->fio = $request->fio;
        $user->save();
        $path = base_path('.env');
        $nameSite = $request->namesite;

        if (file_exists($path) && $nameSite) {
            file_put_contents($path, str_replace(
                'APP_NAME=Laravel', 'APP_NAME='."'".$nameSite."'", file_get_contents($path)
            ));
        }
            $file = $request->file('favicon');
            Storage::put('favicon.ico', $file);
        return redirect('/login');
    }
}
