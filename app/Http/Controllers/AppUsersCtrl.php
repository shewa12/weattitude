<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;//request is for form input values 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;//hasching
use Illuminate\Support\Facades\Auth;//auth for get logged in info

use Illuminate\Http\UploadedFile;//for upload files

use admin\User;//user model
class AppUsersCtrl extends Controller
{
	function __construct(){
		$this->middleware('auth');
	}
 	function getUsers(){
 		$title= "App Users";
		$users = User::select()
					->where('role',0)
		 			->orderBy('id','desc')
		 			->get();
					   
		
 		return view('admin.appusers')->with(['title'=>$title,'users'=>$users]);
 	}

 	function saveUser(Request $request){
        $this->validate($request, [

            'email' => 'required|email|max:255|unique:users',

        ]);
 		if($request->hasFile('image')){
 			if($request->file('image')->isValid()){
 				if( $request->file('image')->storeAs("avatars", $request->file('image')->getClientOriginalName())){
 					$user= new User([
 						'image'=>$request->file('image')->getClientOriginalName(),
 						'image_path'=>$request->file('image')->path(),
 						'name'=>$request->name,
 						
 						'email'=>$request->email,
 						'password'=>$request->password
 						/*'age'=>$request->age,
 						'address'=>$request->address,
 						'phoneNumber'=>$request->phoneNumber,
 						'region'=>$request->region,
 						'zipCode'=>$request->zipCode,
 						'recognitionSign'=>$request->recognitionSign,
 						'about'=>$request->about
 						*/
 						]);
 				
 					if($user->save()){
 						return redirect()->route('appUsers')->with('success','User Added Succefully!');
 					}
 					else{
 						return redirect()->route('appUsers')->with('fail','Failed to Add User!');

 					}
 				}
 			}
 			else{
 					return redirect()->route('appUsers')->with('fail','Image Is Not Valid!');

 			}
 		}

 		
 	}

 	function updateUser(Request $request){

 		if($request->hasFile('image')){
 			if($request->file('image')->isValid()){
 				if( $request->file('image')->storeAs("avatars", $request->file('image')->getClientOriginalName())){
 					$user= User::where('id',$request->id)
 						->update([
 						'image'=>$request->file('image')->getClientOriginalName(),
 						'image_path'=>$request->file('image')->path(),
 						'name'=>$request->name,
 						
 						'email'=>$request->email,
 						'password'=>$request->password
 						/*
 						'age'=>$request->age,
 						'address'=>$request->address,
 						'phoneNumber'=>$request->phoneNumber,
 						'region'=>$request->region,
 						'zipCode'=>$request->zipCode,
 						'recognitionSign'=>$request->recognitionSign,
 						'about'=>$request->about
 						*/
 						]);
 				
 					if($user){
 						return redirect()->route('appUsers')->with('success','User Updated Succefully!');
 					}
 					else{
 						return redirect()->route('appUsers')->with('fail','Failed to Update User!');

 					}
 				}
 			}
 			else{
 					return redirect()->route('appUsers')->with('fail','Image Is Not Valid!');

 			}
 		}//if image not added
 		else{
 				$user= User::where('id', $request->id)
 						->update([

 					//'image'=>$request->img,
 					//'image_path'=>$request->img_path,
 					'name'=>$request->name,
 					
 					'email'=>$request->email,
 					'password'=>$request->password
 					/*
 					'age'=>$request->age,
 					'address'=>$request->address,
 					'phoneNumber'=>$request->phoneNumber,
 					'region'=>$request->region,
 					'zipCode'=>$request->zipCode,
 					'recognitionSign'=>$request->recognitionSign,
 					'about'=>$request->about
 					*/
 				]);

 				if($user){
 					return redirect()->route('appUsers')->with('success','User Updated Succefully!');
 				}
 				else{
 					return redirect()->route('appUsers')->with('fail','User Update Failed!');

 				}
 		}

 	}


 	function deleteUser($id){
 		$user= User::where('id',$id)
 					 ->delete();

 	}
}
