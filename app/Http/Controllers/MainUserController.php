<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;
use App\Models\User;
class MainUserController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function UserProfile(){
        $id=Auth::user()->id;
        $user=User::find($id);
        return view('user.profile.view_profile',['user'=>$user]);
    }

    public function UserProfileEdit(){
        $id=Auth::user()->id;
        $user=User::find($id);
        return view('user.profile.view_profile_edit',['user'=>$user]);
    }

    public function UserProfileStore(Request $request){
        $id=Auth::user()->id;
        $user=User::find($id);
        
        $user->name=$request->name;
        $user->email=$request->email;

        if($request->file('profile_photo_path')){
            $file=$request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/'.$user->profile_photo_path));
            $img_ext=strtolower($file->getClientOriginalExtension());
            $name_gen=hexdec(uniqid());
            $filename=$name_gen. '.'.$img_ext;
            $up_location='upload/user_images';
            $file->move($up_location,$filename);
            
            $user['profile_photo_path']=$filename;
        }
        $user->save();
        $notification=array(
            'message'=> 'profile is updated successfully',
            'alert-type'=>'success'
        );

        return redirect()->route('user.profile')->with($notification);


        }


        public function UserPassword(){
            $id=Auth::user()->id;
            $user=User::find($id);
            return view('user.password.edit_password',['user'=>$user]);

        }

        public function UserPasswordUpdate(Request $request){
            
            $validated=$request->validate([
                'oldpassword'=> 'required',
                'password'=> 'required|confirmed',
            ]);
            $hashedpassword=Auth::user()->password;
            if(Hash::check($request->oldpassword,$hashedpassword)){
                $user=User::find(Auth::id());
                $user->password=Hash::make($request->password);
                $user->save();
                Auth::logout();
    
                return redirect()->route('login');
            
            }else{
                return redirect()->back();
    
    
            }
    


        }



    
}
