<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SubCategory;
use App\models\SubsubCategory;
use App\models\Category;

class SubCategoryController extends Controller
{
    public function SubcategoryView(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
    	$subcategory = SubCategory::latest()->paginate(5);
    	return view('backend.category.subcategory.subcategory_view',compact('subcategory','categories'));

    }
    public function SubCategoryStore(Request $request){

        $request->validate([
             'category_id' => 'required',
             'subcategory_name_en' => 'required',
             'subcategory_name_bn' => 'required',
         ],[
             'category_id.required' => 'Please select Any option',
             'subcategory_name_en.required' => 'Input SubCategory English Name',
         ]);
 
 
 
        SubCategory::insert([
         'category_id' => $request->category_id,
         'subcategory_name_en' => $request->subcategory_name_en,
         'subcategory_name_bn' => $request->subcategory_name_bn,
         'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
         'subcategory_slug_bn' => str_replace(' ', '-',$request->subcategory_name_bn),
 
 
         ]);
 
         
 
         return redirect()->back()->with('message','SubCategory Inserted Successfully');
 
     } // end method 

     public function SubcategoryEdit($id){
    	$categories = Category::orderBy('category_name_en','ASC')->get();
    	$subcategory = SubCategory::findOrFail($id);
    	return view('backend.category.subcategory.subcategory_edit',compact('subcategory','categories'));

    }


    public function SubCategoryUpdate(Request $request, $id){

    	

    	 SubCategory::findOrFail($id)->update([
		'category_id' => $request->category_id,
		'subcategory_name_en' => $request->subcategory_name_en,
		'subcategory_name_bn' => $request->subcategory_name_bn,
		'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
		'subcategory_slug_bn' => str_replace(' ', '-',$request->subcategory_name_bn),


    	]);

	    

		return redirect()->route('all.subcategory')->with('message','SubCategory Updated Successfully');

    }  // end method



    public function SubCategoryDelete($id){

    	SubCategory::findOrFail($id)->delete();

		return redirect()->back()->with('message','SubCategory Deleted Successfully');

    }


    /////////// This is for Sub->SubCategory //////////////

    public function  SubsubcategoryView(){
        $categories = Category::orderBy('category_name_en','ASC')->get();
    	$subsubcategory = SubsubCategory::latest()->paginate(5);
    	return view('backend.category.subsubcategory.sub_subcategory',compact('subsubcategory','categories'));
    }
        public function GetSubCategory($category_id){

            $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
            return json_encode($subcat);
        }

        public function GetSubSubCategory($subcategory_id){

            $subsubcat = SubsubCategory::where('subcategory_id',$subcategory_id)->orderBy('subsubcategory_name_en','ASC')->get();
            return json_encode($subsubcat);
        }



        public function SubSubCategoryStore(Request $request){

            $request->validate([
                 'category_id' => 'required',
                 'subcategory_id' => 'required',
                 'subsubcategory_name_en' => 'required',
                 'subsubcategory_name_bn' => 'required',
             ],[
                 'category_id.required' => 'Please select Any option',
                 'subsubcategory_name_en.required' => 'Input SubSubCategory English Name',
             ]);
     
     
     
            SubsubCategory::insert([
             'category_id' => $request->category_id,
             'subcategory_id' => $request->subcategory_id,
             'subsubcategory_name_en' => $request->subsubcategory_name_en,
             'subsubcategory_name_bn' => $request->subsubcategory_name_bn,
             'subsubcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_en)),
             'subsubcategory_slug_bn' => str_replace(' ', '-',$request->subsubcategory_name_bn),
     
     
             ]);
     
             
     
             return redirect()->back()->with('message','Data Inserted Successfully');
     
         } // end method 
     
     
         public function SubSubCategoryEdit($id){
            $categories = Category::orderBy('category_name_en','ASC')->get();
            $subcategories = SubCategory::orderBy('subcategory_name_en','ASC')->get();
            $subsubcategories = SubsubCategory::findOrFail($id);
            return view('backend.category.subsubcategory.sub_subcategory_edit',compact('categories','subcategories','subsubcategories'));
    
        }
    
    
    
        public function SubSubCategoryUpdate(Request $request){
    
            $subsubcat_id = $request->id;
    
            SubsubCategory::findOrFail($subsubcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_hin' => $request->subsubcategory_name_hin,
            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_hin' => str_replace(' ', '-',$request->subsubcategory_name_hin),
    
    
            ]);
    
            
            return redirect()->route('all.subsubcategory')->with('message','Data Updated Successfully');
    
        } // end method 

        public function SubSubCategoryDelete($id){

            SubsubCategory::findOrFail($id)->delete();
             $notification = array(
                'message' => 'Sub-SubCategory Deleted Successfully',
                'alert-type' => 'info'
            );
    
            return redirect()->back()->with('message','Data Updated Successfully');
    
    
        }
    
    
     
   
   

    }





                                                                                                                                         

    

