<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;//db facades
use Illuminate\Support\Facades\Auth;
use admin\Interests;
use admin\InterestDatas;

class InterestCtrl extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    function getAllInterest(){

        $interests= InterestDatas::get();        
        return $interests;
    }     
    function getInterest(){

        $id= Auth::id();
        $title= "Interest";
        $interests= Intereststext::select('interestText.*')
                    ->join('interestText','interestText.id','=','interests.interest_id')
                    ->where('interests.user_id',$id)
                    ->orderBy('id','desc')
                    ->get();        
        
        return view('admin/interest')->with(['title'=>$title,'interests'=>$interests]);
    }  
  



    function saveInterest(Request $request){
        $id= Auth::id();
        $n= count($request->interest);
        for($i=0; $i<$n; $i++){
            $location= new Interests([
                'interest_id'=>$request->interest[$i],
                'user_id'=>$id
            ]); 
            $location->save();            
        }

    	return redirect()->back()->with('success','Your skill added!');

    }

    function updateInterest(Request $request){
    	$location = Locations::where('id', $request->id)
    					->update([
                        'country'=>$request->country,
                        'city'=>$request->city,
                        'address'=>$request->address
                        ]);
   		if($location){
    		return redirect()->route('getLocations')->with('success','Location Updated!');

   		} 
   		else{
    		return redirect()->route('getLocations')->with('fail','Location Could Not Update!');

   		}					
    }

    function deleteInterest($id){
 		$location= Interests::where('id',$id)
 					 ->delete();
     
    }

    function searchInterest($interest){
            
            $interests= InterestDatas::select()
                        ->where('interest','like','%'.$interest.'%')
                        ->get();
            if(count($interests)>0){
                echo"
                    <div class='form-group'>
                        <select class='form-control' name='interest_id'>
                ";                 
                foreach ($interests as $key => $value) {
                   
                    echo 
                    "

                            <option value='$value->id'>$value->interest</option>

                    ";
                }
            echo "
                        </select>
                    </div>
                ";    
            }
            else{
                    echo 
                    "
 
                    No record found
                    ";                
            }
    }

    function lastWeekInterest(){
        $q= DB::select(DB::raw("
            SELECT id FROM interests
            WHERE created_at >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
            AND created_at < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY
        "));

        $total= count($q);
        $parcent=2;
        $lastWeek= ($total*$parcent)/100;
        return $lastWeek;
    }

}
