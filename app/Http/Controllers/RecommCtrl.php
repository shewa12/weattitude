<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;//auth for get logged in info
use admin\Http\Controllers\RegionsCtrl;
use admin\Issues;
use admin\Recomm;
use admin\Regions;
use admin\Locations;
use admin\IssueRecommJunction;
use admin\RecommMarkDelete;
use admin\RecommSuggestion;

class RecommCtrl extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }    

    function getRecomm(Request $request){
        $user_id= Auth::id();
        $title= "Issues";

        $recomm= Recomm::select('recomm.recommendation','recomm.id')
                    ->join('issue_recomm_junction as irj','irj.recomm_id','=','recomm.id')
                    ->join('issues as i','i.id','=','irj.issue_id')
                    ->where('i.user_id',$user_id)
                    ->whereIn('irj.issue_id',$request->userIssue)
                    ->orderBy('recomm.id','desc')
                    ->get();

        return view('users/recomm')->with(['title'=>$title,'recomm'=>$recomm,'selected_issue'=>$request->userIssue]);
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
        //$region_id= $request->region_id;//array
        $issue_id= $request->specific_issue;//arr

        $recomm= Recomm::select('recomm.recommendation','recomm.id')
                    ->join('issue_recomm_junction as irj','irj.recomm_id','recomm.id')
                    ->join('issues as i','i.id','=','irj.issue_id')
                    ->whereIn('irj.issue_id',$issue_id)
                    ->orderBy('recomm.id','desc')
                    ->get();

        return view('users/recomm')->with(['title'=>$title,'recomm'=>$recomm,'selected_issue'=>$issue_id]);
    }
//below 2 function is for getting issue name and location but not implemented in view right now
/*    
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
*/ 
    function checkDuplicateRecomm(){
        $issue_id= explode(',',$_POST['issue_id']);
        $recomm= $_POST['recomm'];


        $q= Recomm::where('recomm.recommendation','like','%'.$recomm.'%')
                ->join('issue_recomm_junction as irj','irj.recomm_id','=','recomm.id')
                ->join('issues as i','i.id','=','irj.issue_id')
                ->whereIn('irj.issue_id',$issue_id)
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
        $issue_id= explode(',',$request->issue_id);//str to arr

        $recomm=[
            'user_id'=>$user_id,
            'recommendation'=>$request->recommendation
        ];
        //saving recomm 
        $saveRecomm= new Recomm($recomm);
        if($saveRecomm->save()){

            //get the latest id 
            $recomm_id= Recomm::latest('id')->first();
     
            //putting record to regionIssueJunction
            for($i=0; $i<count($issue_id); $i++){
                $post=new IssueRecommJunction([
                    'issue_id'=>$issue_id[$i],
                    'recomm_id'=>$recomm_id->id
                ]);
                $post->save();

            }         

        }
        else{
            return redirect()->route('home')->with('fail','Recommendation Add failed!');
        }

        return redirect()->route('home')->with('success','Recommendation Added!');
            //return redirect()->back()->with('success','Issue Added!');
    
    }    

    function getRecommByIssue(){
        $issue_id= $_POST['issue_id'];
        $obj=[];
        $recomm= Recomm::select('recomm.id','recomm.recommendation')
                    ->join('issue_recomm_junction as irj','irj.recomm_id','=','recomm.id')
                    ->whereIn('irj.issue_id',$issue_id)
                    ->get();
        if(count($recomm)>0){
            foreach($recomm as $value){
                $obj[]= [
                    'text'=>$value->recommendation,
                    'value'=>$value->id
                ];

            }
            echo json_encode($obj);
        }            
        else{
            echo json_encode("no record found");
        }
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

    function markDelete($type_id){
        $post=[
            'user_id'=>Auth::id(),
            'recomm_id'=>$type_id

            ];
        $q= RecommMarkDelete::where($post)->get();
        if(count($q)>0){
            echo "You have already marked for delete!";
        }
        else{
            $q= new RecommMarkDelete($post);
            if($q->save()){
                echo "Marked for delete!";
            }           
            else{
                echo "something went wrong, please try again!";
            }
        }

    }

    function deleteRecomm($id){
        $user= Recomm::where('id',$id)
                     ->delete();
     
    }

    //offer recommendation for a issue
    function offerRecomm($issue_id){
        $title= "Offer Recommendation";
        $regionObj= new RegionsCtrl;
        $getRegionByIssueId= $regionObj->getRegionByIssueId($issue_id);

        $recomm= Recomm::select('recomm.recommendation','recomm.id')
                    ->join('issue_recomm_junction as irj','irj.recomm_id','recomm.id')
                    ->join('issues as i','i.id','=','irj.issue_id')
                    ->where('irj.issue_id',$issue_id)
                    ->orderBy('recomm.id','desc')
                    ->get();

        return view('users/offer_recomm')->with(['title'=>$title,'recomm'=>$recomm,'selected_issue'=>$issue_id,'getRegionByIssueId'=>$getRegionByIssueId,'issueName'=>$this->issueNameByid($issue_id)]);
    }

    function saveOfferRecomm(Request $request){
        $user_id= Auth::id();
        $issue_id= $request->issue_id;

        $recomm=[
            'user_id'=>$user_id,
            'recommendation'=>$request->recommendation
        ];

        //saving recomm 
        $saveRecomm= new Recomm($recomm);
        if($saveRecomm->save()){

            //get the latest id 
            $recomm_id= Recomm::latest('id')->first();
            $post= [
                'issue_id'=>$issue_id,
                'recomm_id'=>$recomm_id->id
            ];      

            if($this->savingOfferRecomm($post)){
                return redirect()->back()->with('success','Recommendation Added!'); 
            }
            else{
                return redirect()->back()->with('fail','Recommendation Add failed!');
            }
        }
        else{
            return redirect()->back()->with('fail','Recommendation Add failed!');
        }


            //return redirect()->back()->with('success','Issue Added!');
    }

    function savingOfferRecomm($post){
        $q= new IssueRecommJunction($post);

        if($q->save()){
            return true;
        }
    }

    function issueNameByid($issue_id){
        if(is_array($issue_id)){
            $q= Issues::select('content')
                    ->whereIn('id',$issue_id)
                    ->get();

            return $q;              
        }
        else{
            $q= Issues::select('content')
                    ->where('id',$issue_id)
                    ->get();

            return $q;              
        }
      
    } 

    function recommSuggestion(){
        $post=[
            'user_id'=>Auth::id(),
            'recomm_id'=>$_POST['recomm_id']
            //'content'=>$_POST['issue_suggest']

        ];

        $q= RecommSuggestion::where($post)->get();
        if(count($q)>0){
            echo "exists";
        }
        else{
            $post=[
                'user_id'=>Auth::id(),
                'recomm_id'=>$_POST['recomm_id'],
                'content'=>$_POST['recomm_suggest']

            ];            
            $q= new RecommSuggestion($post);
            if($q->save()){
                echo "success";
            }           
            else{
                echo "something went wrong, please try again!";
            }
        }
    }
    function lastWeekRecomm(){
        $q= DB::select(DB::raw("
            SELECT id FROM recomm
            WHERE created_at >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
            AND created_at < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY
        "));

        $total= count($q);
        $parcent=2;
        $lastWeek= ($total*$parcent)/100;
        return $lastWeek;
    }

}
