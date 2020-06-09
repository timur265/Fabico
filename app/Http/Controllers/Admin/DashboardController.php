<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends Controller
{

    public function dashboard()
    {
        return view('admin.pages.dashboard');
    }

    public function login()
    {
        return view('admin.pages.loginPage');
    }

    public function dashboardColorChange ()
    {
        if(Cookie::get('dashboardColor') != false)
        {
            if(Cookie::get('dashboardColor') == 'white')
            {
                Cookie::forget('dashboardColor');
                Cookie::queue('dashboardColor', 'black', (60 * 60 * 24 * 30));
            }
            else{
                Cookie::forget('dashboardColor');
                Cookie::queue('dashboardColor', 'white', (60 * 60 * 24 * 30));
            }
        }else{
            Cookie::queue('dashboardColor', 'black', (60 * 60 * 24 * 30));
        }

        return redirect()->route('admin.index');
    }
}
