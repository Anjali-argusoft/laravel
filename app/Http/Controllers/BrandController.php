<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    public function Allbrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index',  compact('brands'));
    }
    public function addBrand(Request $request)
    {
        $validated = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_image' => 'required|mimes:jpg,jpeg,png',
            ],
            [
                'brand_name.required' => 'Please Provide brand name',
            ]
        );

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $image_ext = strtolower($image->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$image_ext;
        $location = 'image/brand/';

        $image->move($location, $img_name);
        $image_path = $location.$img_name;

        //Insert Brand using Eloquent ORM method second process

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $image_path ,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->back()->with('success', 'Brand inserted successfully');
    }

    public function Edit($id)
    {
       $brands = Brand::find($id);
     // $categories = DB::table('categories')->where('id',$id)->first();
      return view('admin.brand.edit', compact('brands'));
    }
  
    public function Update(Request $request, $id)
    {
      $brands = Brand::find($id)->update([
        'brand_name' => $request->brand_name,
        
      ]);
     
      // $date = array();
      // $data['category_name'] = $request->category_name;
      // $data['user_id'] = Auth::user()->id;
      // $categories = DB::table('categories')->where('id',$id)->update($data);
  
      return Redirect()->route('brand')->with('success', 'Category updated successfully');
    }
}



