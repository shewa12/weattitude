<?php

namespace admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;//db facades
use admin\InterestDatas;
use admin\User;
use admin\Videos;
use admin\Locations;
use admin\Regions;
use admin\Issues;
use admin\Recomm;
use admin\Skills_resources_required as Skills;
use admin\Funds;
use admin\OngoingProjects;
use PDF;
class VisitorsCtrl extends Controller
{   
    public function __construct()
    {
        
    }
    function index(){
        $interests= InterestDatas::select('interest')
                        ->get();
        return view('auth.homepage',['title'=>'Homepage','interests'=>$interests]);
    }

    function aboutUs(){
        $inflows= Funds::where('fund_type','Inflow')
                    ->get();
        $outflows= Funds::where('fund_type','Outflow')
                    ->get();
        return view('auth.aboutus',['title'=>'About Us','inflows'=>$inflows,'outflows'=>$outflows]);

    }

    function funds(){
        $inflows= Funds::where('fund_type','Inflow')
                    ->get();
        $outflows= Funds::where('fund_type','Outflow')
                    ->get();
        return view('auth.funds',['title'=>'Funds Inflow-Outflow','inflows'=>$inflows,'outflows'=>$outflows]);
    }

    function whyParticipate(){
        return view('auth.why_participate',['title'=>'Why Participant']);
    }
    function dataByInterest(Request $request){

   
        $post= $request->interest;
      
        $data=[
            'user_interests'=>$post
        ];
        $json= json_encode($data);
        $URL="http://ec2-52-32-196-57.us-west-2.compute.amazonaws.com/ocpu/library/WEattitudeAnalytx/R/sample.show.me.fun/json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$URL);
       // curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        //curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
            'Accept: application/json',
            'Content-Type: application/json')                                                           
        );        
        $result=curl_exec ($ch);
        
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
        $status_code;
        $apiData= json_decode($result);
        //echo "<pre>";
        //print_r($apiData);
        curl_close ($ch); 
    
        //'mapinfo'=>$apiData->map_info_output,'interests'=>$apiData->user_interests
        // dd($apiData);

        //$this->interestMarker($apiData->map_info_output);
        
        return view('auth.interest_view_map',['title'=>'Interest View','solutions'=>$apiData->soln_to_skill_table,'mapInfo'=>$apiData->map_info_output,'interests'=>$post]);

    }

    static function interestMarker($mapInfo=null){
    $dom = new \DOMDocument("1.0");
    $node = $dom->createElement("markers");
    $parnode = $dom->appendChild($node); 

    if(count($mapInfo)>0){
            //header("Access-Control-Allow-Origin: *");
        foreach ($mapInfo as $key => $value) {

            $node = $dom->createElement("marker");
            $newnode = $parnode->appendChild($node);
            $newnode->setAttribute("loc_name",$value->loc_name);

            $newnode->setAttribute("loc_lat",$value->loc_lat);
            $newnode->setAttribute("loc_lon",$value->loc_lat);

            }   
        }
            return  response($dom->saveXML(),200)
                    ->header('Content-Type', 'text/xml');
    }

    function searchInterestPublic($interest){
            
            $interests= InterestDatas::select()
                        ->where('interest','like','%'.$interest.'%')
                        ->get();
            if(count($interests)>0){
                echo"
                    <div class='form-group'>
                        <select class='form-control' id='interest' name='interest_id' onChange='getValue()'>
                ";                 
                foreach ($interests as $key => $value) {
                   
                    echo 
                    "

                            <option value='$value->id'>$value->interest</option>

                    ";
                }
            echo "
                        </select>
                    </div>
                ";    
            }
            else{
                    echo 
                    "
 
                    No record found
                    ";                
            }
    }

    function writingVideos(){
        $title= "Uplifting Writing and Videos";
        $tags= Videos::select('tags')
                    ->get();
        $data= Videos::select('videos.*','u.name','u.image')
                    ->join('users as u','u.id','=','videos.user_id')
                    ->orderBy('videos.id','desc')
                    ->get();

        return view('auth.writing_videos',['title'=>$title,'videoContents'=>$data,'tags'=>$tags]);
    }      

    function writingVideosTag($tag){
        $title= "Uplifting Writing and Videos | ".$tag;
        $tags= Videos::select('tags')
                    ->get();
        $data= Videos::select('videos.*','u.name','u.image')
                    ->join('users as u','u.id','=','videos.user_id')
                    ->where('videos.tags','like','%'.$tag.'%')
                    ->orderBy('videos.id','desc')
                    ->get();

        return view('auth.writing_videos',['title'=>$title,'videoContents'=>$data,'tags'=>$tags]);
    }  

    function writingVideosDetail($id){
        $data= Videos::select('videos.*','u.name','u.image')
                    ->join('users as u','u.id','=','videos.user_id')
                    ->where('videos.id',$id)
                    ->orderBy('videos.id','desc')
                    ->get();
        $title= "Uplifting Writing and Videos Detail";

        return view('auth.writing_videos_detail',['title'=>$title,'videoContents'=>$data]);

    }  

    function hangoutSheet(){
        $title= "Hangout Sheet for Your Community";
        return view('auth.hangout_sheet',['title'=>$title]);
    }    

    function doParticipants(){
        $title= "What do Participants Get in Return ";
        return view('auth.do_participants',['title'=>$title]);
    }
//issue and suggested solution
    function searchRegion($location, $hangout= null){

            $regions= Locations::select()
                        ->where('location_name','like','%'.$location.'%')
                        ->get();
            if(count($regions)>0){
                if($hangout=="true"){
                    echo "<div class='hangout-region'>";
                foreach ($regions as $key => $value) {
                   
                    echo 
                        '
                        <li onClick ="hangout('.$value->id.',\''.$value->location_name.'\')">'.$value->location_name.'</li>
                        ';
                    }
                    echo
                    "
                    </div>
                    ";                    
                }

                else{
                echo"
                    <div class='form-group'>
                        <select class='form-control' name='location_id' id='region'>
                ";                 
                foreach ($regions as $key => $value) {
                   
                    echo 
                    "

                            <option id='' value='$value->id'>$value->location_name</option>

                    ";
                }
            echo "
                        </select>
                    </div>
                "; 

            }//else end
   
            }
            else{
                    echo 
                    "
 
                    No record found
                    ";                
            }
    }    

//search solution
    function searchSolution($solution){

            $solutions= Recomm::select()
                        ->where('recommendation','like','%'.$solution.'%')
                        ->get();
            if(count($solutions)>0){
                echo"
                    <div class='form-group'>
                        <select class='form-control' name='solution' id='region'>
                ";                 
                foreach ($solutions as $key => $value) {
                   
                    echo 
                    "
                            <option id='' value='$value->recommendation'>$value->recommendation</option>
                    ";
                }
            echo "
                        </select>
                    </div>
                ";    
            }
            else{
                    echo 
                    "
 
                    No record found
                    ";                
            }
    }        
//search solution end

//search issue    
    function searchIssue($issue){

            $issues= Issues::select()
                        ->where('content','like','%'.$issue.'%')
                        ->get();
            if(count($issues)>0){
                echo"
                    <div class='form-group'>
                        <select class='form-control' name='issue' id='region'>
                ";                 
                foreach ($issues as $key => $value) {
                   
                    echo 
                    "

                            <option id='' value='$value->content'>$value->content</option>

                    ";
                }
            echo "
                        </select>
                    </div>
                ";    
            }
            else{
                    echo 
                    "
 
                    No record found
                    ";                
            }
    }        
//search issue end    
    function issueSuggestedSolution(){

        $title= "Issues & Suggested Solution";
        $recomm= Recomm::select("recomm.*",'i.content','i.severity', 'l.location_name','l.id as locationId')
                    ->join('issues as i','i.id','=','recomm.issue_id')
                    ->join('regions as r','i.region_id','=','r.id')
                    ->join('locations as l','l.id','=','r.location_id')                    
                    //->where('recomm.user_id',$id)
                    ->orderBy('id','desc')
                    ->get();
        return view('auth.issue_suggested',['title'=>$title,'recomm'=>$recomm]);
    }
    
    
    function searchIssubyRegion($id){
        $i=1;
        $q= Regions::select('l.location_name', 'i.content', 're.recommendation' ,'re.initiatives', 'i.severity')
                ->join('locations as l','l.id','=','regions.location_id')
                ->join('issues as i','i.region_id','=','regions.id')
                ->join('recomm as re','re.issue_id','=','i.id')
                ->where('regions.location_id',$id)
                ->orderBy('i.id',"desc")
                ->get();
        if(count($q)>0){
            
            echo 
            "
            <div class='table-responsive'>
                <table class='table table-border'>
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Regions</th>
                            <th>Issues</th>
                            <th>Severities</th>
                            <th>Initiatives</th>
                            <th>Recommendations</th>
                            
                        </tr>
            ";
            foreach($q as $value){
                
                echo 
                "
                <tr>
                    <td>".$i++."</td>
                    <td>$value->location_name</td>
                    <td>$value->content</td>
                    <td>$value->severity</td>
                    <td>$value->initiatives</td>
                    <td>$value->recommendation</td>
                </tr>
                ";
            }

            echo 
            "
            <table>
        </div>
            ";
        }   
        else{
            echo 
            "
            <h3>No record found</h3>
            ";
        }     
    }
    
    function issue_detail($id){
        $title= "Issues & Suggested Solution | Detail";
        $recomm= Recomm::select("recomm.*",'i.content','i.issue_popularity_count','i.severity','i.region_id','l.location_name','l.lat','l.lng')
                    ->join('issues as i','i.id','=','recomm.issue_id')
                    ->join('regions as r','i.region_id','=','r.id')
                    ->join('locations as l','l.id','=','r.location_id')                    
                    ->where('recomm.id',$id)
                    ->orderBy('id','desc')
                    ->first();
            $recomm_id= $recomm->id;
            $issue_id= $recomm->issue_id;
            $region_id= $recomm->region_id;
            
            if($recomm_id>0){
                $otherRecomm= Recomm::select("recomm.*")
                                ->join('issues as i','i.id','recomm.issue_id')
                                //->join('regions as r','r.id','i.region_id')
                                ->where(['i.id'=>$issue_id,'i.region_id'=>$region_id])
                                ->where('recomm.id','!=',$recomm_id)
                                ->orderBy('id','desc')
                                ->get();
                $skills= Skills::select('skills_required','icon')
                                ->where('recomm_id',$recomm_id)
                                ->orderBy('id','desc')
                                ->get();
                $otherIssue= Issues::select('id','content' ,'issue_ranking_within_region','issue_popularity_count')
                                ->where('region_id', $region_id)
                                //->where('id','!=',$issue_id)
                                ->get();
               //dd($otherIssue);
                return view('auth.issue_detail',['title'=>$title,'recomm'=>$recomm,'skills'=>$skills,'otherRecomm'=>$otherRecomm,'otherIssue'=>$otherIssue]);                                 
            }        
       
    }

//issue and suggested solution end   

//advance search start
    function advanceSearch(Request $request){
        $location_id= $request->location_id;
        $solution= $request->solution;
        $issue= $request->issue;
        $q= Regions::select('l.location_name', 'i.content', 're.recommendation' ,'re.initiatives', 'i.severity')
                ->join('locations as l','l.id','=','regions.location_id')
                ->join('issues as i','i.region_id','=','regions.id')
                ->join('recomm as re','re.issue_id','=','i.id')
                ->where('i.content','=',$issue)
                ->orWhere('regions.location_id','=',$location_id)
                ->orWhere('re.recommendation','=',$solution)
                ->orderBy('i.id',"desc")
                ->get();
         return view('auth.advance_search',['title'=>"Advance Search", 'data'=>$q]);
    }

//advance search end

//Case study start 
    function caseStudy(){
        $indicators= OngoingProjects::select('project_indicator.*')
                ->join('project_indicator','project_indicator.project_id','=','ongoing_project.id')
                ->orderBy('ongoing_project.id','desc')
                ->get();
        $projects= OngoingProjects::orderBy('id','desc')
                    ->get();        
      
        return view('auth.case_study',['title'=>"Case Study",'projects'=>$projects,'indicators'=>$indicators]);
    }
//Case study start end

//hangout start
    function postHangout($region){
        //{"user_regions":["region_name"]}
        $data= [
            "user_regions"=>[$region]
        ];
      

        $json= json_encode($data);

        $URL="http://ec2-52-32-196-57.us-west-2.compute.amazonaws.com/ocpu/library/WEattitudeAnalytx/R/sample.handout.sheet.fun/json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$URL);
       // curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        //curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
            'Accept: application/json',
            'Content-Type: application/json')                                                           
        );        
        $result=curl_exec ($ch);
        
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
        
        $apiData= json_decode($result);

        curl_close ($ch); 
        $url= url('/download-handout'); 
        echo 
        "
            <form action='$url' method='post' style='margin-bottom:50px;'>
            ".csrf_field()."
            <div class='col-md-6 col-lg-4 handout' style='background:#ffffcc; border:3px solid #ffcf9d;padding:20px; '>
            ";
        foreach ($apiData as $key => $value) {
            echo 
            "
                <div>$value->handout_data</div>
                <br/>
                <input type='hidden' name='data[]' value='$value->handout_data'>
            "; 
        }
        echo 
        "   <button style='margin-top:20px;' class='btn btn-default'>Print/Download</button>
            </div>
            </form>
        ";


    }
    function downloadHandout(Request $request){
        
        $data=$request->data;

        $pdf = PDF::loadView('auth.handout_pdf',compact('data',$data));      
        return $pdf->stream('handout.pdf'); //stream is use for preview    
        //return $pdf->download('invoice.pdf');  //download is for direct download   

    }       
//hangout end
}
