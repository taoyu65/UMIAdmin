<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashBoardController extends Controller
{
    public function dashboard(Request $request)
    {
        $userName = $request->get('username');
        $password = $request->get('password');
        if (Auth::attempt(['name' => $userName, 'password' => $password])) {
            return view('umi::dashboard');
        } else {
            return view('umi::login', ['error' => '<script>alert("please check username or password")</script>']);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        Cache::flush();
        return redirect()->route('admin');
    }

    public function getRefresh()
    {
        Cache::flush();
        return redirect()->route('dashboard');
    }
}
