<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
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
        return view('frontend.index',compact('categories','sliders','products'));
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
		$product = Product::findOrFail($id);
        $multiImag = MultiImg::where('product_id',$id)->get();
	 	return view('frontend.product.product_details',compact('product','multiImag'));

	}
}
