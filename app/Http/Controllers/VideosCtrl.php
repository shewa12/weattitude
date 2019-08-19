<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//auth for get logged in info
use admin\Videos;

class VideosCtrl extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }    
    function getVideos(){
        $id= Auth::id();
        $title= "Videos-essay";
        $videos= Videos::where('user_id',$id)
                    ->orderBy('id','desc')
                    ->get();

        return view('admin/videos')->with(['title'=>$title,'videos'=>$videos]);
    }

    function saveVideo(Request $request){
        $id= Auth::id();
        $video= $_FILES['video']['name'];
        if(!empty($video)){
                if( $request->file('video')->storeAs("videos", $request->file('video')->getClientOriginalName())){
                    $video= new Videos([
                        'title'=>$request->title,
                        'video'=>$request->file('video')->getClientOriginalName(),
                        'videoPath'=>$request->file('video')->path(),
                        'essay'=>$request->essay,
                        'user_id'=>$id,
                        'tags'=>$request->tags
   
                        ]);
                
                    if($video->save()){
                        return redirect()->route('getVideos')->with('success','Video / Essay Added Succefully!');
                    }
                    else{
                        return redirect()->route('getVideos')->with('fail','Failed to Add Video!');

                    }
                }
                else{
                    return redirect()->route('getVideos')->with('fail','File could not store!');

                }
            
        }
        else{
                    $video= new Videos([
                        'title'=>$request->title,
                        'essay'=>$request->essay,
                        'user_id'=>$id,
                        'tags'=>$request->tags
   
                        ]);
                
                    if($video->save()){
                        return redirect()->route('getVideos')->with('success','Video / Essay Added Succefully!');
                    }
                    else{
                        return redirect()->route('getVideos')->with('fail','Failed to Add Video!');

                    }    
            
            
        }//else end


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

    function deleteVideo($id){
        $video= Videos::where('id',$id)
                     ->delete();
     
    }
}
