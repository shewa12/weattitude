<?php

namespace admin\Http\Controllers;
use Illuminate\Support\Facades\DB;
use admin\Http\Controllers\RegionsCtrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//auth for get logged in info
use admin\Issues;
use admin\Regions;
use admin\Locations;
use admin\IssueMarkDelete;
use admin\IssueSuggestion;
use admin\RegionIssueJunction;

class IssueCtrl extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }    

    function yourRegion(Request $request){

    	$title= "Your Region";
        $user_id= Auth::id();
        $region= new RegionsCtrl;
        $issues=    Locations::select('i.*','locations.location_name')
                    ->join('region_issue_junction as rij','rij.region_id','locations.id')
                    ->join('issues as i','i.id','=','rij.issue_id')
                    ->where('i.user_id',$user_id)
                    ->whereIn('locations.id',$request->userLocation)
                    ->orderBy('i.id','desc')
                    ->distinct('rij.issue_id')
                    ->get();

        return view('users/issues')->with(['title'=>$title,'selected_region'=>$region->LocationNameById($request->userLocation) ,'issues'=>$issues]);
    }

    function specificRegion(Request $request){
        $title= "Specific Region";
        $region= new RegionsCtrl;
        $issues= Locations::select("i.*",'locations.location_name')
                    ->join('region_issue_junction as rij','rij.region_id','=','locations.id')
                    ->join('issues as i','i.id','=','rij.id')
                    ->whereIn('locations.id',$request->locations)
                    ->orderBy('i.id','desc')
                    ->get();

        return view('users/issues')->with(['title'=>$title,'selected_region'=>$region->LocationNameById($request->locations) ,'issues'=>$issues]);
    }

    function checkDuplicateIssue(){

        $region_id= explode(',',$_POST['region_id']);
        $content= $_POST['content'];

        $q= Issues::where('issues.content','like','%'.$content.'%')
                ->join('region_issue_junction as rij','rij.issue_id','=','issues.id')
                ->join('locations as l','l.id','=','rij.region_id')
                ->whereIn('rij.region_id',$region_id)
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
        $region_id= $request->region_id;//comma separated string

        $idArr= explode(',',$region_id);//string to arr

        //saving issue
        $issue=[
            'user_id'=>$user_id,
            'content'=>$request->content
        ];
        //saving issue 
        $saveIssue= new Issues($issue);
        if($saveIssue->save()){

            //get the latest id 
            $issue_id= Issues::latest('id')->first();
     
            //putting record to regionIssueJunction

            for($i=0; $i<count($idArr); $i++){
                $post=new RegionIssueJunction([
                    
                    'region_id'=>$idArr[$i],
                    'issue_id'=>$issue_id->id
                ]);
                $post->save();

            }         

        }

        else{
            return redirect()->route('home')->with('success','Issue Add failed!');
        }
        return redirect()->route('home')->with('success','Issue Added!');
    		//return redirect()->back()->with('success','Issue Added!');
 

    }
    //getting auth user issue
    function getUserIssue($user_id){

        $q= Issues::select('issues.id','issues.content','l.location_name')
            ->join('region_issue_junction as rij','rij.issue_id','=','issues.id')
            ->join('locations as l','l.id','=','rij.region_id')
            ->where('issues.user_id',$user_id)
            ->get();
        return $q;        
    }    

    function getAllIssues(){

        $q= Issues::select('issues.id','issues.content','l.location_name')
            ->join('region_issue_junction as rij','rij.issue_id','=','issues.id')
            ->join('locations as l','l.id','=','rij.region_id')
            //->where('issues.user_id',$user_id)
            ->get();
        return $q;   
    }

    function getIssueForRegion(){
        $content= $_POST['content'];
        $region= $_POST['region'];

        $q= Issues::select('id','content')
                ->where('content','like','%'.$content.'%')
                ->whereIn('location_id', $region)
                ->first();

        if(is_null($q)){
            echo "false";
        }
        else{
            echo "<option value='".$q->id."' style='overflow:hidden'>".substr($q->content,0,50)."...</option>";
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

    function markDelete($type_id){
        $post=[
            'user_id'=>Auth::id(),
            'issue_id'=>$type_id

            ];
        $q= IssueMarkDelete::where($post)->get();
        if(count($q)>0){
            echo "You have already marked for delete!";
        }
        else{
            $q= new IssueMarkDelete($post);
            if($q->save()){
                echo "Marked for delete!";
            }           
            else{
                echo "something went wrong, please try again!";
            }
        }

    }

    function issueSuggestion(){
        $post=[
            'user_id'=>Auth::id(),
            'issue_id'=>$_POST['issue_id']
            //'content'=>$_POST['issue_suggest']

        ];

        $q= IssueSuggestion::where($post)->get();
        if(count($q)>0){
            echo "exists";
        }
        else{
            $post=[
                'user_id'=>Auth::id(),
                'issue_id'=>$_POST['issue_id'],
                'content'=>$_POST['issue_suggest']

            ];            
            $q= new IssueSuggestion($post);
            if($q->save()){
                echo "success";
            }           
            else{
                echo "something went wrong, please try again!";
            }
        }
    }

    function lastWeekIssue(){
        $q= DB::select(DB::raw("
            SELECT id FROM issues
            WHERE created_at >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
            AND created_at < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY
        "));

        $total= count($q);
        $parcent=1;
        $lastWeek= ($total*$parcent)/100;
        return $lastWeek;
    }
    
}
