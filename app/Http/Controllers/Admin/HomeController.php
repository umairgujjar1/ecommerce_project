<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(){
    //    $admin= Auth::guard('admin')->user();
        // echo 'welcome'.'<a href="'. route('admin.logout').'">logout</a> <br>'.$admin->name;
    return view('Admin.dashboard');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
