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
  public function getcategories()
  {
    //  $categories = DB::table('categories')
    //  ->join('users', 'categories.user_id', 'users.id')
    //  ->select('categories.*', 'users.name')
    //  ->latest()->paginate(5);
     $categories = Category::latest()->paginate(5);
     $trashcat = Category::onlyTrashed()->latest()->paginate(5);
    // query builder method
    //  $categories = DB::table('categories')->latest()->paginate(5);
    return view('admin.category.index', compact('categories', 'trashcat'));
  }
  public function addCategory(Request $request)
  {
    $validated = $request->validate(
      [
        'category_name' => 'required|unique:categories|max:255',
      ],
      [
        'category_name.required' => 'Please Provide category name',
        'category_name.unique' => 'Please Provide unique category name',
        'category_name.max' => 'Category name max limit exceed',
      ]
    );

    // Insert category using Eloquent ORM method
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

    // // Insert category using Query Builder method 
    //  $date = array();
    //  $data['category_name'] = $request->category_name;
    //  $data['user_id'] = Auth::user()->id;
    //  $data['created_at'] = Carbon::now();
    //  DB::table('categories')->insert($data);


    return Redirect()->back()->with('success', 'Category inserted successfully');
  }

  public function Edit($id)
  {
     $categories = Category::find($id);
   // $categories = DB::table('categories')->where('id',$id)->first();
    return view('admin.category.edit', compact('categories'));
  }

  public function Restore($id)
  {
     $categories = Category::withTrashed()->find($id)->restore();
     return Redirect()->route('categories')->with('success', 'Category restored successfully');
  }

  public function Update(Request $request, $id)
  {
    $categories = Category::find($id)->update([
      'category_name' => $request->category_name,
      'user_id' => Auth::user()->id
    ]);
    // $date = array();
    // $data['category_name'] = $request->category_name;
    // $data['user_id'] = Auth::user()->id;
    // $categories = DB::table('categories')->where('id',$id)->update($data);

    return Redirect()->route('categories')->with('success', 'Category updated successfully');
  }

  public function SoftDelete($id)
  {
    $categories = Category::find($id)->delete();
    // $categories = DB::table('categories')->where('id',$id)->delete();
    return Redirect()->route('categories')->with('success', 'Category SoftDeleted successfully');
  }

  public function Delete($id)
  {
    $categories = Category::onlyTrashed()->find($id)->forceDelete();
    return Redirect()->route('categories')->with('success', 'Category permanently deleted successfully');
  }

  public function search(Request $request)
  {
    $search_text = $request->input('search');
       
    $categories = DB::table('categories')
     ->join('users', 'categories.user_id', 'users.id')
     ->select('categories.*', 'users.name')->where('category_name', 'LIKE', "%{$search_text}%")
    ->latest()->paginate(5);
  
    return view('admin.category.search', compact('categories'));
    
  }

  public function filter(Request $request){
    
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');

    if(isset($start_date) && isset($end_date)){
    $categories = DB::table('categories')
        ->join('users', 'categories.user_id', 'users.id')
        ->select('categories.*', 'users.name')
        ->whereBetween('categories.created_at', [$start_date." 00:00:00",$end_date." 23:59:59"])
        ->latest()->paginate(5);  
    } 
    else {
    $categories = DB::table('categories')
     ->join('users', 'categories.user_id', 'users.id')
     ->select('categories.*', 'users.name')
     ->latest()->paginate(5);
    }

    return view('admin.category.search', compact('categories'));
  }


}
