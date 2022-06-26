<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function BrandView(){
        $brands=Brand::latest()->paginate(5);
        return view('backend.brand.brand_view',compact('brands'));
    }
    public function BrandStore(Request $request){

        $brand=new Brand();

        $brand->brand_name_en=$request->brand_name_en;
        $brand->brand_name_bn=$request->brand_name_bn;
        $brand->brand_slug_en=strtolower(str_replace(' ','_',$request->brand_name_en));
        $brand->brand_slug_bn=str_replace(' ','_',$request->brand_name_bn);
  
        if($request->file('brand_image')){
            $file=$request->file('brand_image');
           
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->storeAs('brand_image', $filename, 'public');
            $brand['brand_image']=$filename;
        }
    
        $brand->save();
        return redirect()->back()->with('message','Brand Inserted Successfully');
    }

    public function BrandEdit($id){
$brand=Brand::findOrFail($id);
return view('backend.brand.brand_edit',compact('brand'));
    }

    public function BrandUpdate(Request $request,$id){

        $brand=Brand::find($id);

      $brand->brand_name_en=$request->brand_name_en;
      $brand->brand_name_bn=$request->brand_name_bn;
      $brand->brand_slug_en=strtolower(str_replace(' ','_',$request->brand_name_en));
      $brand->brand_slug_bn=str_replace(' ','_',$request->brand_name_bn);

      // if($request->file('profile_photo_path')){
      //    $file=$request->file('profile_photo_path');
      //    @unlink(public_path('profile_photo_path'.$adminUpdate->profile_photo_path));
      //    $filename=date('YmdHi').$file->getClientOriginalName();
      //    $file->move(public_path('upload/admin_images'),$filename);
      //    $adminUpdate['profile_photo_path']=$filename;
      // }
      if($request->file('brand_image')){
        $file=$request->file('brand_image');
       
        $filename=date('YmdHi').$file->getClientOriginalName();
        $file->storeAs('brand_image', $filename, 'public');
        $brand['brand_image']=$filename;
    }
      $brand->save();
      return redirect()->route('all.brand')->with('message','Brand Updated Successfully');

    }

    public function BrandDelete($id){
        Brand::find($id)->delete();
        return redirect()->back()->with('message','Brand Deleted Successfully');
    }
}
