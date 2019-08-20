<?php

namespace admin\Http\Controllers;
use Illuminate\Support\Facades\DB;
use admin\Http\Controllers\RegionsCtrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//auth for get logged in info
use admin\Issues;
use admin\Regions;
use admin\Locations;

class IssueCtrl extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }    
    function yourRegion(Request $request){

    	$title= "Your Region";
        $region= new RegionsCtrl;
        $issues= Locations::select("i.*",'locations.location_name')
                    //->join('regions as r','r.location_id','=','locations.id')
                    //->join('issues as i','i.region_id','=','r.id')
                    //->whereIn('r.location_id',$request->userLocation)
                    //->orderBy('i.id','desc')                    
                    
                    ->join('issues as i','i.location_id','=','locations.id')
                    ->whereIn('locations.id',$request->userLocation)
                    ->orderBy('i.id','desc')
                    ->get();

        return view('users/issues')->with(['title'=>$title,'selected_region'=>$region->LocationNameById($request->userLocation) ,'issues'=>$issues]);
    }

    function specificRegion(Request $request){
        $title= "Specific Region";
        $region= new RegionsCtrl;
        $issues= Locations::select("i.*",'locations.location_name')
                    //->join('regions as r','r.location_id','=','locations.id')
                    ->join('issues as i','i.location_id','=','locations.id')
                    ->whereIn('locations.id',$request->locations)
                    ->orderBy('i.id','desc')
                    ->get();

        return view('users/issues')->with(['title'=>$title,'selected_region'=>$region->LocationNameById($request->locations) ,'issues'=>$issues]);
    }

    function checkDuplicateIssue($content){
        $q= Issues::where('content','like','%'.$content.'%')
                ->get();
        if(count($q)>0){
            echo "duplicate";
        }
        else{
            echo "ok";
        }
    }

    function saveIssue(Request $request){
        $user_id= Auth::id();
        $region_id= $request->region_id;
        $idArr= explode(',',$region_id);
        for($i=0; $i<count($idArr); $i++){
            $post=new Issues([
                'user_id'=>$user_id,
                'location_id'=>$idArr[$i],
                'content'=>$request->content
            ]);
            $post->save();

        }

        return redirect()->route('home')->with('success','Issue Added!');
    		//return redirect()->back()->with('success','Issue Added!');
 

    }

    function getUserIssue($user_id){

        $q= Issues::select('id','content')
            ->where('user_id',$user_id)
            ->get();
        return $q;        
    }    

    function getAllIssues(){
        $q= Issues::select('id','content')
            //->where('user_id',$user_id)
            ->get();
        return $q; 
    }
    function updateIssue(Request $request){
    	$services = Issues::where('id', $request->id)
    					->update(['name'=>$request->name]);
   		if($services){
    		return redirect()->route('getServices')->with('success','Service Updated!');

   		} 
   		else{
    		return redirect()->route('getServices')->with('fail','Service Could Not Update!');

   		}					
    }

    function deleteIssue($id){
 		$user= Issues::where('id',$id)
 					 ->delete();
     
    }
}
