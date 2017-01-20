<?php

namespace YM\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use YM\Umi\UrlAuth;

class DashBoardController extends Controller
{
    public function dashboard(Request $request)
    {
        var_dump('this is dash');
        $userName = $request->get('username');
        $password = $request->get('password');
        if (Auth::attempt(['name' => $userName, 'password' => $password])) {
            //test
            $user = Auth::user();
            $urlAuth = new UrlAuth($user);
            dd($urlAuth->menuAttributions());
            return view('');
        } else {
            return view('umi::login', ['error' => '<script>alert("please check username or password")</script>']);
        }
    }
}
