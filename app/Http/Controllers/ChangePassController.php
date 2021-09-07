<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Auth;
use Image;

use Illuminate\Support\Facades\Hash;

class ChangePassController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function logout(){
        Auth::logout();
        return Redirect()->route('login')->with('success', 'User Logout');
    }

    public function changePassword(){
        return view('admin.body.change_password');
    }

    public function updatePassword(Request $request){
        $validateData=$request->validate([
            'current_password'=>'required',
            'password'=>'required|confirmed'
        ]);

        $hashedPassword=Auth::user()->password;

        if(Hash::check($request->current_password, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return Redirect()->route('login')->with('success', 'Password has been change');
        }else{
            return Redirect()->back()->with('error', 'Invalid current password');
        }
    }

    public function profileEdit(){
        if(Auth::user()){
            $user=User::find(Auth::user()->id);
            if($user){
                return view('admin.body.update_profile', compact('user'));
            }
        }
    }

    public function profileUpdate(Request $request){
        $user=User::find(Auth::user()->id);
        if($user){
            $user->name = $request->name;
            $user->email = $request->email;

            $old_image=$request->old_image;
            $new_image=$request->file('profile_photo_path');
            $last_img=$old_image;
            if($new_image){
                $name_gen=hexdec(uniqid()).'.'.$new_image->getClientOriginalExtension();
                $last_img='storage/profile-photos/'.$name_gen;
                Image::make($new_image)->resize(300, 200)->save($last_img);
        
                // unlink($old_image);    
            }

            $user->save();
            return Redirect()->back()->with('success', 'User profile successfully changed');
        }else{
            return Redirect()->back();
        }

    }
}
