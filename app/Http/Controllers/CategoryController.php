<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
      public function getcategories(){
        return view('admin.category.index');
    }
}
