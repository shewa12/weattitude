<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//auth for get logged in info
use Illuminate\Support\Facades\DB;//auth for get logged in info
use admin\Issues;
use admin\Recomm;
use admin\Regions;
use admin\Locations;
use admin\Initiatives;
use admin\RecommInitJunction;
use admin\InitiativesMarkDelete;
use admin\InitiativeSuggestion;

class InitiativesCtrl extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }    

    function getInitiative(Request $request){
        $id= Auth::id();
        $title= "Initiatives";
        $recomm_id= $request->recomm_id;
        $init= Initiatives::select('initiatives.content','initiatives.id')
                    ->join('recomm_init_junction as rij','rij.init_id','=','initiatives.id')
                    ->join('recomm as r','r.id','=','rij.recomm_id')
                    
                    ->whereIn('rij.recomm_id',$recomm_id)
                    ->orderBy('initiatives.id','desc')
                    ->get();


        return view('users/init')->with(['title'=>$title,'init'=>$init,'selected_recomm'=>$recomm_id]);
    }

    function offerInit($recomm_id){
        $title= "Offer Initiatives";
        $init= Initiatives::select('initiatives.content', 'initiatives.id')
                    ->join('recomm_init_junction as rij','rij.init_id','=','initiatives.id')
                    ->join('recomm as r','r.id','=','rij.recomm_id')
                    
                    ->where('rij.recomm_id',$recomm_id)
                    ->orderBy('initiatives.id','desc')
                    ->get();


        return view('users/offer_init')->with(['title'=>$title,'init'=>$init,'selected_recomm'=>$recomm_id]);        
    }


    function checkDuplicateInit(){
        $recomm_id= explode(',',$_POST['recomm_id']);
        $initiatives= $_POST['initiatives'];

        $q= Initiatives::where('initiatives.content','like','%'.$initiatives.'%')
                ->join('recomm_init_junction as rij','rij.init_id','=','initiatives.id')
                ->join('recomm as r','r.id','=','rij.recomm_id')
                ->whereIn('rij.recomm_id',$recomm_id)
                ->get();                
        if(count($q)>0){
            echo "duplicate";
        }
        else{
            echo "ok";
        }

    }  

    function saveInit(Request $request){
        $user_id= Auth::id();
        $recomm_id= explode(',',$request->recomm_id);//str to arr

        $initiatives=[
            'user_id'=>$user_id,
            'content'=>$request->content
        ];
        //saving init 
        $saveInit= new Initiatives($initiatives);
        if($saveInit->save()){

            //get the latest id 
            $init_id= Initiatives::latest('id')->first();
     
            //putting record to recommInitJunction
            for($i=0; $i<count($recomm_id); $i++){
                $post=new RecommInitJunction([
                    'recomm_id'=>$recomm_id[$i],
                    'init_id'=>$init_id->id
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


    function saveOfferInit(Request $request){
        $user_id= Auth::id();
        $recomm_id= $request->recomm_id;

        $initiatives=[
            'user_id'=>$user_id,
            'content'=>$request->content
        ];
        //saving init 
        $saveInit= new Initiatives($initiatives);
        if($saveInit->save()){

            //get the latest id 
            $init_id= Initiatives::latest('id')->first();
            $post=[
                'init_id'=>$init_id->id,
                'recomm_id'=>$recomm_id
            ];
            if($this->savingOfferInit($post)){
                return redirect()->back()->with('success','Initiative Added!');                
            }
            else{
                return redirect()->back()->with('fail','Initiative Add failed!');
            }

        }
        else{
            return redirect()->back()->with('fail','Initiative Add failed!');
        }


            //return redirect()->back()->with('success','Issue Added!');
    }   

    function savingOfferInit($post){
        $q= new RecommInitJunction($post);

        if($q->save()){
            return true;
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

    function markDelete($type_id){
        $post=[
            'user_id'=>Auth::id(),
            'initiatives_id'=>$type_id

            ];
        $q= InitiativesMarkDelete::where($post)->get();

        if(count($q)>0){
            echo "You have already marked for delete!";
        }
        else{
            $q= new InitiativesMarkDelete($post);
            if($q->save()){
                echo "Marked for delete!";
            }           
            else{
                echo "something went wrong, please try again!";
            }
        }

    }

    function initSuggestion(){
        $post=[
            'user_id'=>Auth::id(),
            'initiatives_id'=>$_POST['issue_id']
            //'content'=>$_POST['issue_suggest']

        ];

        $q= InitiativeSuggestion::where($post)->get();
        if(count($q)>0){
            echo "exists";
        }
        else{
            $post=[
                'user_id'=>Auth::id(),
                'initiatives_id'=>$_POST['issue_id'],
                'content'=>$_POST['issue_suggest']

            ];            
            $q= new InitiativeSuggestion($post);
            if($q->save()){
                echo "success";
            }           
            else{
                echo "something went wrong, please try again!";
            }
        }
    }

    function lastWeekInitiatives(){
        $q= DB::select(DB::raw("
            SELECT id FROM initiatives
            WHERE created_at >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
            AND created_at < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY
        "));

        $total= count($q);
        $parcent=3;
        $lastWeek= ($total*$parcent)/100;
        return $lastWeek;
    }

}
