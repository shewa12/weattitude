<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;//request is for form input values 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;//hasching
use Illuminate\Support\Facades\Auth;//auth for get logged in info

use Illuminate\Http\UploadedFile;//for upload files

use admin\User;//user model
class Users extends Controller
{
	function __construct(){
		$this->middleware('auth');
	}
 	function getUsers(){
 		$title= "Users";
		$users = User::select()
					->where('role',1)
		 			->orderBy('id','desc')
		 			->get();
					   
		
 		return view('admin.users')->with(['title'=>$title,'users'=>$users]);
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
 						'age'=>$request->age,
 						'email'=>$request->email,
 						'password'=>$request->password,
 						'address'=>$request->address,
 						'phoneNumber'=>$request->phoneNumber,
 						'region'=>$request->region,
 						'zipCode'=>$request->zipCode,
 						'role'=>1,
 						'recognitionSign'=>$request->recognitionSign,
 						'about'=>$request->about
 						]);
 				
 					if($user->save()){
 						return redirect()->route('users')->with('success','User Added Succefully!');
 					}
 					else{
 						return redirect()->route('users')->with('fail','Failed to Add User!');

 					}
 				}
 			}
 			else{
 					return redirect()->route('users')->with('fail','Image Is Not Valid!');

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
 						'age'=>$request->age,
 						'email'=>$request->email,
 						'password'=>$request->password,
 						'address'=>$request->address,
 						'phoneNumber'=>$request->phoneNumber,
 						'region'=>$request->region,
 						'zipCode'=>$request->zipCode,
 						'recognitionSign'=>$request->recognitionSign,
 						'about'=>$request->about
 						]);
 				
 					if($user){
 						return redirect()->route('users')->with('success','User Added Succefully!');
 					}
 					else{
 						return redirect()->route('users')->with('fail','Failed to Update User!');

 					}
 				}
 			}
 			else{
 					return redirect()->route('users')->with('fail','Image Is Not Valid!');

 			}
 		}//if image not added
 		else{
 				$user= User::where('id', $request->id)
 						->update([

 					//'image'=>$request->img,
 					//'image_path'=>$request->img_path,
 					'name'=>$request->name,
 					'age'=>$request->age,
 					'email'=>$request->email,
 					'password'=>$request->password,
 					'address'=>$request->address,
 					'phoneNumber'=>$request->phoneNumber,
 					'region'=>$request->region,
 					'zipCode'=>$request->zipCode,
 					'recognitionSign'=>$request->recognitionSign,
 					'about'=>$request->about
 				]);

 				if($user){
 					return redirect()->route('users')->with('success','User Updated Succefully!');
 				}
 				else{
 					return redirect()->route('users')->with('fail','User Update Failed!');

 				}
 		}

 	}


 	function deleteUser($id){
 		$user= User::where('id',$id)
 					 ->delete();

 	}

 	function calendar (){
		$title="calendar view";

					   		
 		return view ('admin.calendar',['title'=>$title]);
 	}

 	function filter(Request $request){
 		$fromDate= $request->fromDate;
 		$endDate= $request->endDate;
 		$f= date("Y-m-d", strtotime($fromDate));
 		$e= date("Y-m-d", strtotime($endDate));
 		$data=User:: whereBetween('created_at', [$f, $e])
 			->get();
 		$i=0;
 		if(count($data)>0){
 		echo "
			<div class='responsive'>
            <table class='table table-bordered table-hover'>
                <thead>
                <tr>
                    <th>Sl No:</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone Number</th>


                </tr>
                </thead>
                <tbody>
 		";
 		foreach($data as $value){
 			$i++;
        echo "
                	<tr>
                		<td>$i</td>
                		<td>$value->name</td>
                		<td>$value->email</td>
                		<td>$value->address</td>
                		<td>$value->phoneNumber</td>

                                  		
                	</tr>

			 ";   		
    }//end foreach
    echo 
    "
                    </tbody>
            </table>    
        </div>
    ";
    }
    else{
    	echo "
            <div class='alert alert-danger'>
              <a class='close' data-dismiss='alert'>×</a>
                <strong>No record found.</strong>
            </div>
    	";
    }
 	}

 	function sendBooking (Request $request){
 		$id= $request->id;
 		$region= $request->region;

 		$user= User::where('id',$id)
 				->first();
 		$email= User::select('email')
 					->where('region',$region)
 					->get();
 		$msg= 
 		"
 		<p>Job No: $user->name</p>
 		<p>Customer Name: $user->email</p>
 		<p>Reference: $user->email</p>
 		<p>Passengar Name: $user->email</p>
 		<p>Mobile: $user->email</p>
 		<p>Email: $user->email</p>
 		<p>Quantity: $user->email</p>
 		<p>Suit Case: $user->email</p>
 		<p>Vehicle Class: $user->email</p>
 		<p>Pickup Detail: $user->email</p>
 		<p>Pickup Location: $user->email</p>
 		<p>Pickup Datetime: $user->email</p>
 		<p>Drop Off Datetime: $user->email</p>
 		<p>Drop Off Location: $user->email</p>
 		<p>Receive: $user->email</p>
 		<p>Receive Type: $user->email</p>
 		<p>Payment: $user->email</p>
 		<p>Payment  Type: $user->email</p>
 		<p>Driver: $user->email</p>
 		<p>Note: $user->email</p>
 		" ;
 		if(count($email)>0){
 			foreach($email as $value){
 			//mail start
 			$to= $value->email;	
 			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <webmaster@example.com>' . "\r\n";
			$headers .= 'Cc: myboss@example.com' . "\r\n";

			mail($to,$subject,$msg,$headers);	
 			//mail end		
 			}
 		}
 	}

}
