<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TempImageController extends Controller
{
    //
public function create(Request $request){
return $request->image;
}

}
