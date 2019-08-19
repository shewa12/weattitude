<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//auth for get logged in info
use admin\Issues;
use admin\Recomm;
use admin\Regions;
use admin\Locations;

class RecommCtrl extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }    
    function getRecomm(){
        $id= Auth::id();
        $title= "Issues";
        $issues= Issues::select('issues.*','l.location_name')
                    ->join('regions as r','issues.region_id','=','r.id')
                    ->join('locations as l','l.id','=','r.location_id')
                    ->orderBy('id','desc')
                    ->where('issues.user_id',$id)
                    ->get();

        $recomm= Recomm::select("recomm.*",'i.content','l.location_name')
                    ->join('issues as i','i.id','=','recomm.issue_id')
                    ->join('regions as r','i.region_id','=','r.id')
                    ->join('locations as l','l.id','=','r.location_id')                    
                    ->where('recomm.user_id',$id)
                    ->orderBy('id','desc')
                    ->get();

        return view('users/recomm')->with(['title'=>$title,'issues'=>$issues,'recomm'=>$recomm]);
    }

    function saveRecomm(Request $request){
        $id= Auth::id();
        $service= new Recomm([
                'user_id'=>$id,
                'issue_id'=>$request->issue_id,
                'recommendation'=>$request->recommendation,
                'initiatives'=>$request->initiatives
            ]);
        if($service->save()){
            return redirect()->route('getRecomm')->with('success','Recommendation / Initiatives Added!');
        }
        else{
            return redirect()->route('getRecomm')->with('fail','Recommendation / Initiatives Could Not Add!');

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

    function deleteRecomm($id){
        $user= Recomm::where('id',$id)
                     ->delete();
     
    }
}
