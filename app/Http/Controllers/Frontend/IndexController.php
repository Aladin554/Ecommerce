<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Brand;
use App\Models\SubCategory;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;

class IndexController extends Controller
{
    public function index(){
        $products=Product::where('status',1)->orderBy('id','DESC')->get();
        $categories=Category::orderBy('category_name_en','ASC')->get();
        $sliders=Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $featured = Product::where('featured',1)->orderBy('id','DESC')->limit(6)->get();
        $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
        $special_offer = Product::where('special_offer',1)->orderBy('id','DESC')->limit(3)->get();
        $special_deal = Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();

        $skip_category_0 = Category::skip(0)->first();
    	$skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->get();

        $skip_category_1 = Category::skip(1)->first();
    	$skip_product_1 = Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->get();

    	$skip_brand_1 = Brand::skip(1)->first();
    	$skip_brand_product_1 = Product::where('status',1)->where('brand_id',$skip_brand_1->id)->orderBy('id','DESC')->get();




        return view('frontend.index',compact('categories','sliders','products','featured','hot_deals','special_offer','special_deal','skip_category_0','skip_product_0','skip_category_1','skip_product_1','skip_brand_1','skip_brand_product_1'));
    }

    public function UserLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function UserProfile(){
        $id=Auth::user()->id;
        $user=User::find($id);
        return view('frontend.profile.user_profile',compact('user'));
    }

    public function UserProfileStore(Request $request){
        $userUpdate=User::find(Auth::user()->id);

        $userUpdate->name=$request->name;
        $userUpdate->email=$request->email;
        $userUpdate->phone=$request->phone;
  
        // if($request->file('profile_photo_path')){
        //    $file=$request->file('profile_photo_path');
        //    @unlink(public_path('profile_photo_path'.$adminUpdate->profile_photo_path));
        //    $filename=date('YmdHi').$file->getClientOriginalName();
        //    $file->move(public_path('upload/admin_images'),$filename);
        //    $adminUpdate['profile_photo_path']=$filename;
        // }
        if ($request->hasFile('profile_photo_path')) {
           $photo = $request->file('profile_photo_path');
           $imageName = "profile_photo_path" . '.' . $photo->extension();
           $userUpdate['profile_photo_path']=$imageName;
           
           $photo->storeAs('user_photo_path', $imageName, 'public');
       }
        $userUpdate->save();
        return redirect()->route('dashboard')->with('message','Admin Profile Updated Successfully');
    }

    public function UserChangePassword(){
        $id=Auth::user()->id;
        $user=User::find($id);
        return view('frontend.profile.change_password',compact('user'));
    }

    public function UserPasswordUpdate(Request $request){
        $validateData=$request->validate([

            'oldpassword'=>'required',
            'password'=>'required | confirmed'
         ]);
   
         $updatePassword=Auth::user()->password;
   
         if(Hash::check($request->oldpassword,$updatePassword)){
            $id=Auth::user()->id;
        $user=User::find($id);
            $user->password=Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
         }
            else{
               return redirect()->back()->with('message','Updated Password');
            }

    }

    public function ProductDetails($id,$slug){
        $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
		$product = Product::findOrFail($id);
        $color_en = $product->product_color_en;
		$product_color_en = explode(',', $color_en);

		$color_bn = $product->product_color_bn;
		$product_color_bn = explode(',', $color_bn);

		$size_en = $product->product_size_en;
		$product_size_en = explode(',', $size_en);

		$size_bn = $product->product_size_bn;
		$product_size_bn = explode(',', $size_bn);

        $multiImag = MultiImg::where('product_id',$id)->get();
        
        $cat_id = $product->category_id;
		$relatedProduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->get();
	 	return view('frontend.product.product_details',compact('product','multiImag','product_color_en','product_color_bn','product_size_en','product_size_bn','relatedProduct','hot_deals'));

	}


    public function TagWiseProduct($tag){
		$products = Product::where('status',1)->where('product_tags_en',$tag)->where('product_tags_bn',$tag)->orderBy('id','DESC')->paginate(3);
        $categories=Category::orderBy('category_name_en','ASC')->get();
        $sliders=Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
		return view('frontend.tag.product_tag_view',compact('products','categories','sliders'));

	}

    public function SubCatWiseProduct($subcat_id,$slug){
		$products = Product::where('status',1)->where('subcategory_id',$subcat_id)->orderBy('id','DESC')->paginate(3);
		$categories = Category::orderBy('category_name_en','ASC')->get();
        $sliders=Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
		return view('frontend.product.subcategory_view',compact('products','categories','sliders'));

	}


    public function SubSubCatWiseProduct($subsubcat_id,$slug){
		$products = Product::where('status',1)->where('subsubcategory_id',$subsubcat_id)->orderBy('id','DESC')->paginate(6);
		$categories = Category::orderBy('category_name_en','ASC')->get();
        $sliders=Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
		return view('frontend.product.sub_subcategory_view',compact('products','categories','sliders'));

	}

    public function ProductViewAjax($id){
		$product = Product::with('category','brand')->findOrFail($id);

		$color = $product->product_color_en;
		$product_color = explode(',', $color);

		$size = $product->product_size_en;
		$product_size = explode(',', $size);

		return response()->json(array(
			'product' => $product,
			'color' => $product_color,
			'size' => $product_size,

		));

	} // end method 



    



}
