<?php

use App\Models\Category;

function getCategory(){

    return Category::latest()
->where('status',1)
    ->with('sub_category')
    ->orderBy('name','ASC')
    ->where('showHome','Yes')
    ->get();

}
