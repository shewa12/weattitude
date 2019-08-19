<?php

namespace admin\Http\Controllers;

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
        
        $id= Auth::id();
    	$title= "Issues";

        $issues= Issues::select("issues.*",'l.location_name')
                    ->join('regions as r','r.id','=','issues.region_id')
                    ->join('locations as l','l.id','=','r.location_id')
                    ->whereIn('r.id',$request->userLocation)
                    ->orderBy('issues.id','desc')
                    ->get();
        return view('users/issues')->with(['title'=>$title,'selected_region'=>$request->userLocation ,'issues'=>$issues]);
    }

    function specificRegion(){

    }

    function saveIssue(Request $request){
        $id= Auth::id();
    	$service= new Issues([
                'user_id'=>$id,
                'region_id'=>$request->region_id,
    			'content'=>$request->content,
    			'severity'=>$request->severity
    		]);
    	if($service->save()){
    		return redirect()->route('getIssues')->with('success','Issue Added!');
    	}
    	else{
    		return redirect()->route('getIssues')->with('fail','Issue Could Not Add!');

    	}
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
