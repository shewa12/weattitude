<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;//db facades
use Illuminate\Support\Facades\Auth;
use admin\Locations;
use admin\Regions;
use admin\Issues;



class RegionsCtrl extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    function getLocations(){
        $id= Auth::id();
        $title= "Locations";
        $locations= Regions::select('locations.*','regions.id','regions.location_id')
                    ->join('locations','locations.id','=','regions.location_id')
                    ->where('regions.user_id',$id)
                    ->orderBy('regions.id','desc')
                    ->get();

        
        return view('admin/location')->with(['title'=>$title,'locations'=>$locations]);
    }    

    function getUserLocation(){
        $id= Auth::id();
        $userLocation= Regions::select('locations.*','regions.id','regions.location_id')
                    ->join('locations','locations.id','=','regions.location_id')
                    ->where('regions.user_id',$id)
                    ->orderBy('regions.id','desc')
                    ->get();  
        return $userLocation;                  
    }

    function getAllLocations(){

        $locations= Locations::get();
        return $locations;

    }

    function saveLocation(Request $request){
        $id= Auth::id();

        $n= count($request->locations);
        for($i=0; $i<$n; $i++){
            $location= new Regions([
                'location_id'=>$request->locations[$i],
                'user_id'=>$id,
                'criteria'=>$request->criteria
            ]); 
            $location->save();            
        }
        return redirect()->back()->with('success',"Regions added!");
    }    

    function saveSpecificLocation(Request $request){
        $id= Auth::id();

        $n= count($request->locations);
        for($i=0; $i<$n; $i++){
            $location= new Regions([
                'location_id'=>$request->locations[$i],
                'user_id'=>$id,
                'specific_location'=>1
            ]); 
            $location->save();            
        }
        return redirect()->back()->with('success',"Specific Regions added!");
    }

    function updateLocation(Request $request){
    	$location = Regions::where('id', $request->id)
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

    function deleteLocation($id){
 		$location= Regions::where('id',$id)
 					 ->delete();
     
    }

    function searchRegion($location){

            $regions= Locations::select()
                        ->where('location_name','like','%'.$location.'%')
                        ->get();
            if(count($regions)>0){
                echo"
                    <div class='form-group'>
                        <select class='form-control' name='location_id'>
                ";                 
                foreach ($regions as $key => $value) {
                   
                    echo 
                    "

                            <option value='$value->id'>$value->location_name</option>

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
}
