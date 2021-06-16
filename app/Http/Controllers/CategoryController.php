<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Carbon;
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

      // //Insert category using Eloquent ORM method
      //   Category::insert([
      //     'category_name' => $request->category_name,
      //     'user_id' => Auth::user()->id,
      //     'created_at' => Carbon::now()
      //   ]);

      //Insert category using Eloquent ORM method second process
      $category = new Category;
      $category->category_name = $request->category_name;
      $category->user_id = Auth::user()->id;
      $category->save();

      return Redirect()->back()->with('success', 'Category inserted successfully');
  }
}
