<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
      public function getcategories(){
        return view('admin.category.index');
    }
    public function addCategory(Request $request){
      $validated = $request->validate([
        'category_name' => 'required|unique:categories|max:255',
      ],
    [
      'category_name.required' => 'Please Provide category name',
      'category_name.unique' => 'Please Provide unique category name',
      'category_name.max' => 'Category name max limit exceed',
    ]);
  }
}
