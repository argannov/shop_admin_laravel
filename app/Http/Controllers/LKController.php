<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\File;
use App\Bonus;

class LKController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::id())->first();
        return view('client-part.personal.indexPersonal', ['user' => $user]);
    }

    public function editProfile(Request $request)
    {
        $user = User::where('id', Auth::id())->first();
        $user->fio = $request->fio;
        $user->phone = $request->phone;
        $avatar = $request->file('avatar');
        $imgpath = public_path() . '/img/users';
        File::makeDirectory($imgpath, $mode = 0777, true, true);
        if ($avatar) {
            if ($user->avatar != 'user-default.png') {
                $pathAvatar = $_SERVER['DOCUMENT_ROOT'] . '/img/users' . '/' . $user->avatar;
                File::delete($pathAvatar);
            }
            $ext1 = $avatar->getClientOriginalExtension();
            $filename1 = uniqid('avatar_') . '.' . $ext1;
            $user->avatar = $filename1;
            $avatar->move($imgpath, $filename1);
        }
        $user->save();
        return redirect('/personal');
    }

    public function listOrder()
    {
        $orders = Orders::where('user_id', Auth::id())->get();
        return view('client-part.personal.orders', ['order' => $orders]);
    }

    public function BonusIndex()
    {
        $bonusUser = Bonus::where('id_users',Auth::id())->first();
        return view('client-part.personal.bonusPersonal',['bonuses'=>$bonusUser]);
    }

}
