<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
      public function getcategories(){
        $categories = DB::table('categories')
        ->join('users', 'categories.user_id', 'users.id')
        ->select('categories.*', 'users.name')
        ->latest()->paginate(5);
        
        
        //  $categories = Category::latest()->paginate(5);
        // query builder method
        //  $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
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

      // Insert category using Eloquent ORM method
      //   Category::insert([
      //     'category_name' => $request->category_name,
      //     'user_id' => Auth::user()->id,
      //     'created_at' => Carbon::now()
      //   ]);

      // Insert category using Eloquent ORM method second process
      // $category = new Category;
      // $category->category_name = $request->category_name;
      // $category->user_id = Auth::user()->id;
      // $category->save();

      // Insert category using Query Builder method 
        $date = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        DB::table('categories')->insert($data);


      return Redirect()->back()->with('success', 'Category inserted successfully');
  }
}
