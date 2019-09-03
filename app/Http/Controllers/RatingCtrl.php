<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use admin\IssueRating;
use admin\RecommRating;
use admin\InitiativeRating;
class RatingCtrl extends Controller
{

    function createIssueRating(){

    	$post= [
    		'user_id'=>Auth::id(),
    		'issue_id'=>$_POST['type_id'],
    		
    		'rating'=>$_POST['rating']
    	];

    	$q= IssueRating::where([
    		'user_id'=>$post['user_id'],
    		'issue_id'=>$post['issue_id'],
    		
    		])->get();
  
    	if(count($q)>0){
    		
    		echo "exists";
    	}
    	else{
	    	$q= new IssueRating($post);
	    	if($q->save()){
	    		echo "true";
	    	}
	    	else{
	    		echo "false";
	    	}    		
    	}

    }

    function createRecommRating(){
        $post= [
            'user_id'=>Auth::id(),
            'recomm_id'=>$_POST['type_id'],
            
            'rating'=>$_POST['rating']
        ];

        $q= RecommRating::where([
            'user_id'=>$post['user_id'],
            'recomm_id'=>$post['recomm_id'],
            
            ])->get();
  
        if(count($q)>0){
            
            echo "exists";
        }
        else{
            $q= new RecommRating($post);
            if($q->save()){
                echo "true";
            }
            else{
                echo "false";
            }           
        }

    }

    function createInitRating(){
        $post= [
            'user_id'=>Auth::id(),
            'initiatives_id'=>$_POST['type_id'],
            
            'rating'=>$_POST['rating']
        ];

        $q= InitiativeRating::where([
            'user_id'=>$post['user_id'],
            'initiatives_id'=>$post['initiatives_id'],
            
            ])->get();
  
        if(count($q)>0){
            
            echo "exists";
        }
        else{
            $q= new InitiativeRating($post);
            if($q->save()){
                echo "true";
            }
            else{
                echo "false";
            }           
        }

    }    

    function udpateRating($id){

    }
   
    function averageRatingByTypeId($idArr,$type){

    }
}
