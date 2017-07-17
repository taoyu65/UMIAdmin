<?php

namespace YM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function index()
    {
        #get IP Information
        $ips = DB::table('ip_info')->paginate(10);
        $link = $ips->links();
        return view('umi::dashboard', ['ips' => $ips, 'link' => $link]);

//        return view('umi::dashboard');
    }

    public function dashboard(Request $request)
    {
        $userName = $request->get('username');
        $password = $request->get('password');
        if (Auth::attempt(['name' => $userName, 'password' => $password])) {
            #save ip information
            $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
            if($query && $query['status'] == 'success') {
                $country = $query['country'];
                $region = $query['region'];
                $city = $query['city'];
                DB::table('ip_info')->insert([
                    'user_name' => $userName,
                    'ip'        => $ip,
                    'country'   => $country,
                    'region'    => $region,
                    'city'      => $city
                ]);
            }

            if (session('previousUrl'))
                return redirect($request->session()->pull('previousUrl'));

            return redirect()->route('dashboard');
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
        $url = base64_decode($_REQUEST['u']);
        Cache::flush();
        return redirect($url);
    }
}
