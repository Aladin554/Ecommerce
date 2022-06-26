<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminProfileController extends Controller
{
    public function AdminProfile(){
       $adminData=Admin::find(1);
       return view('admin.admin_profile_view',compact('adminData'));
    }

    public function AdminProfileEdit(){
        $adminEdit=Admin::find(1);
        return view('admin.admin_profile_Edit',compact('adminEdit'));
     }

     public function AdminProfileUpdate(Request $request){
       
      $adminUpdate=Admin::find(1);

      $adminUpdate->name=$request->name;
      $adminUpdate->email=$request->email;

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
         $adminUpdate['profile_photo_path']=$imageName;
         
         $photo->storeAs('profile_photo_path', $imageName, 'public');
         
     }
      $adminUpdate->save();
      return redirect()->route('admin.profile')->with('message','Admin Profile Updated Successfully');
     
   }

   public function AdminChangePassword(){
      return view('admin.admin_change_password');
   }

   public function AdminUpdatePassword(Request $request){
      $validateData=$request->validate([

         'oldpassword'=>'required',
         'password'=>'required | confirmed'
      ]);

      $updatePassword=Admin::find(1)->password;

      if(Hash::check($request->oldpassword,$updatePassword)){
         $admin=Admin::find(1);
         $admin->password=Hash::make($request->password);
         $admin->save();
         Auth::logout();
         return redirect()->route('admin.logout');
      }
         else{
            return redirect()->back();
         }
      
      
   }
}
