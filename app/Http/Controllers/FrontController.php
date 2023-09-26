<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index(){

        $featured_products = Product::latest()->where('is_featured','Yes')->take(8)->where('status',1)->get();
        $latest_products = Product::latest()->where('status',1)->take(8)->get();
        return view('User.home',compact('featured_products','latest_products'));
    }
}
