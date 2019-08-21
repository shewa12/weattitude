<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    function getRecomm(Request $request){
        $user_id= Auth::id();
        $title= "Issues";


        $recomm= Recomm::select('recommendation')
                   
                    ->where('user_id',$user_id)
                    ->whereIn('issue_id',$request->userIssue)
                    ->orderBy('id','desc')
                    ->get();

        return view('users/recomm')->with(['title'=>$title,'recomm'=>$recomm,'selected_user_issue'=>$request->userIssue]);
    }     

    function getUserRecomm($user_id){

        $recomm= Recomm::select('recommendation')
                   
                    ->where('user_id',$user_id)
                    //->whereIn('issue_id',$request->userIssue)
                    ->orderBy('id','desc')
                    ->get();
        return $recomm;            

    }    

    function specRecomm(Request $request){

        $title= "Specific Issues";
        $region_id= $request->region_id;//array
        $issue_id= $request->issue_id;
        $recomm= Recomm::where('issue_id',$issue_id)
                    //->whereIn('issue_id',$request->userIssue)
                    ->orderBy('id','desc')
                    ->distinct('content')
                    ->get();

        return view('users/specific_issue_recomm')->with(['title'=>$title,'recomm'=>$recomm,'selected_issue'=>$issue_id,'selected_region'=>$region_id]);
    }
//below 2 function is for getting issue name and location but not implemented in view right now
    function issueNameByid($issueArr){
        $q= Issues::select('content')
                ->whereIn('id',$issueArr)
                ->get();

        return $q;        
    }

    function issueRegionByid($issueArr){
        $q= Issues::select('l.location_name')
                ->join('locations as l','l.id','=','issues.location_id')
                ->whereIn('issues.id',$issueArr)
                ->get();

        return $q; 
    }
 
    function checkDuplicateRecomm(){
        $issue_id= explode(',',$_POST['issue_id']);
        $recomm= $_POST['recomm'];

        $q= Recomm::where('recommendation','like','%'.$recomm.'%')
                ->whereIn('issue_id',$issue_id)
                ->get();
        if(count($q)>0){
            echo "duplicate";
        }
        else{
            echo "ok";
        }

    }   

    function saveRecomm(Request $request){
        $user_id= Auth::id();
        $issue_id= $request->issue_id;

        $issue_with_loc= $this->getLocationByIssueId($issue_id);
        foreach($issue_with_loc as $key=>$v){
            $post= new Recomm([
                'user_id'=>$v->user_id,
                'location_id'=>$v->location_id,
                'issue_id'=>$v->id,
                'recommendation'=>$request->recommendation
            ]);
            $post->save();
        }

        return redirect()->route('home')->with('success','Recommendation Added!');
            //return redirect()->back()->with('success','Issue Added!');
    
    }    

    function saveSpecIssueRecomm(Request $request){
        $user_id= Auth::id();
        $issue_id= $request->issue_id;
        $region_id= explode(',',$request->region_id);
        for ($i=0; $i <count($region_id); $i++) { 
            $post= new Recomm([
                'user_id'=>$user_id,
                'issue_id'=>$issue_id,
                'location_id'=>$region_id[$i],
                'recommendation'=>$request->recommendation
            ]);

            $post->save();
        }

        return redirect()->route('home')->with('success','Recommendation Added!');
            //return redirect()->back()->with('success','Issue Added!');
    
    }

    function getLocationByIssueId($issue_id){
        $arr= explode(',', $issue_id);
        $q= Issues::whereIn('id',$arr)->get();
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

    function deleteRecomm($id){
        $user= Recomm::where('id',$id)
                     ->delete();
     
    }
}
