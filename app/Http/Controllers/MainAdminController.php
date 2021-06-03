<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


class MainAdminController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function AdminProfile(){
        $admin=Admin::find(1);
        return view('admin.profile.view_profile',['admin'=>$admin]);
    }

    public function AdminProfileEdit(){
        $admin=Admin::find(1);
        return view('admin.profile.view_profile_edit',['admin'=>$admin]);
    }

    public function AdminProfileStore(Request $request){
        $admin=Admin::find(1);;
        
        $admin->name=$request->name;
        $admin->email=$request->email;

        if($request->file('profile_photo_path')){
            $file=$request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/'.$admin->profile_photo_path));
            $img_ext=strtolower($file->getClientOriginalExtension());
            $name_gen=hexdec(uniqid());
            $filename=$name_gen. '.'.$img_ext;
            $up_location='upload/admin_images';
            $file->move($up_location,$filename);
            
            $admin['profile_photo_path']=$filename;
        }
        $admin->save();
        $notification=array(
            'message'=> 'profile is updated successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('admin.profile')->with($notification);


    }
}
