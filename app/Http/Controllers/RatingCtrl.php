<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use admin\Rating;
class RatingCtrl extends Controller
{
    function createRating(){
    	$post= [
    		'user_id'=>Auth::id(),
    		'type_id'=>$_POST['type_id'],
    		'type'=>$_POST['type'],
    		'rating'=>$_POST['rating']
    	];

    	$q= Rating::where([
    		'user_id'=>$post['user_id'],
    		'type_id'=>$post['type_id'],
    		'type'=>$post['type']
    		])->get();
  
    	if(count($q)>0){
    		
    		echo "exists";
    	}
    	else{
	    	$q= new Rating($post);
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
