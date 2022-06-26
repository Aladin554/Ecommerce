<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Category;

class CategoryController extends Controller
{
    public function CategoryView(){
        $categorys=Category::latest()->paginate(5);
        return view('backend.category.category_view',compact('categorys'));
    }
    public function categoryStore(Request $request){

        $category=new Category();

        $category->category_name_en=$request->category_name_en;
        $category->category_name_bn=$request->category_name_bn;
        $category->category_slug_en=strtolower(str_replace(' ','_',$request->category_name_en));
        $category->category_slug_bn=str_replace(' ','_',$request->category_name_bn);
        $category->category_icon=$request->category_icon;
        
        $category->save();
        return redirect()->back()->with('message','category Inserted Successfully');
    }

    public function CategoryEdit($id){
$category=Category::findOrFail($id);
return view('backend.category.category_edit',compact('category'));
    }

    public function CategoryUpdate(Request $request,$id){

        $category=Category::find($id);

      $category->category_name_en=$request->category_name_en;
      $category->category_name_bn=$request->category_name_bn;
      $category->category_slug_en=strtolower(str_replace(' ','_',$request->category_name_en));
      $category->category_slug_bn=str_replace(' ','_',$request->category_name_bn);
      $category->category_icon=$request->category_icon;
    
      $category->save();
      return redirect()->route('all.category')->with('message','category Updated Successfully');

    }

    public function CategoryDelete($id){
        Category::find($id)->delete();
        return redirect()->back()->with('message','category Deleted Successfully');
    }
}
