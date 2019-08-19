<?php
 
namespace admin\Http\Controllers;
use admin\Http\Controllers\InterestCtrl;
use admin\Http\Controllers\RegionsCtrl;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;//for file upload
use admin\Worklog ;
use admin\User;
use admin\InterestDatas;
use admin\Interests;
use admin\Locations;
use admin\Regions;
use admin\Issues;
use admin\Recomm;
use PDF;
class HomeController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function test(){
        return view('users.test');
    }
    public function index()
    {

        $title= "Dashboard";
        $interest= new InterestCtrl;
        $region= new RegionsCtrl;

        return view('users/dashboard')->with(['title'=>$title,'interests'=>$interest->getAllInterest(),'locations'=>$region->getAllLocations(),'userRegion'=>$region->getUserLocation()]);
    }

    function workLog(){
        $title= "work-log";
        $id= Auth::id();
        $date= date('Y-m-d');
        $worklog= worklog::where('user_id',$id)
                        ->where('created_at',$date)
                        ->orderBy('id', 'desc')
                        ->get();        
        return view('users/worklog')->with(['title'=>$title,'worklog'=>$worklog]);
    }

    function saveWorklog(Request $request){
        $date= date('Y-m-d');

        $data= [
            'hour'=>$request->hour,
            'title'=>$request->title,
            'description'=>$request->detail
            ];
        $worklog= worklog::where(['hour'=>$request->hour,'created_at'=>$date])
            ->count();
        if($worklog >0){
            return redirect()->route('workLog')->with('fail',"You have aleary entered this hour!");
        }
        $worklog= new Worklog([
            'user_id' => Auth::id(),//getting active id
            'hour'=>$request->hour,
            'title'=>$request->title,
            'description'=>$request->detail
            ]);

        $worklog->save();
        return redirect()->route('workLog')->with('success', "data saved successfully!");   
      
    }

    function updateWorklog(Request $request){
        $worklog= Worklog::where('id',$request->id)
                          ->update(['hour'=>$request->hour,'title'=>$request->title,'description'=>$request->detail]) ;
        if($worklog){

            return redirect()->route('workLog')->with('success',"Data updated successfully!");
        }
        else{
            return redirect()->route('workLog')->with('fail',"Data not updated!");

        }
    }
    function deleteWorklog($id){
       $worklog= Worklog::where('id', $id)
                        ->delete();
        if($worklog){
            echo json_encode("Deleted");
        }          
        else{
            echo json_encode("not found");
        }      
    }

    function downloadPDF(){
        $data="hello";
        $pdf = PDF::loadView('admin.htmltopdfview',compact('data',$data));
      
        return $pdf->stream('invoice.pdf'); //stream is use for preview    
        //return $pdf->download('invoice.pdf');  //download is for direct download   

    }   

    function setting(){
        $id= Auth::id();
        $user=  user::all()->where('id',$id)->first();//fetching single row
                            
        return view('setting')->with(['user'=>$user]);
    }
    function updateAccount(Request $request){
        $dir= "uploads";
        /*
        $this->validate($request,[
            'name'=>'unique:users|max:255',
            'email'=>'unique:users',
            ]);
        */    
        //echo $request->user()->id; getting current user id 
       
        if(empty($request->file('image'))){
            $id= Auth::id();
            $user=  user::where('id',$id)
                            ->update([

                            //'name'=>$request->name,
                            //'email'=>$request->email,
                            'image'=>$request->img,
                            'image_path'=>$request->img_path,
                            'fname'=>$request->fname,
                            'lname'=>$request->lname
                            //'password'=>$request->password,
                            
                            ]);

            if($user){
               
               return redirect()->route('setting')->with('success',"Information has updated!");                
            }
        }
        else{
        if($request->hasFile('image')){

            if($request->file('image')->isValid()){
 
               if( $request->file('image')->storeAs("avatars", $request->file('image')->getClientOriginalName())){
                    $id= Auth::id();
                    $user=  user::where('id',$id)
                        ->update([
                        //'name'=>$request->name,
                        //'email'=>$request->email,
                        'fname'=>$request->fname,
                        'lname'=>$request->lname,
                        'image'=>$request->file('image')->getClientOriginalName(),//retrieve filename
                        'image_path'=>$request->file('image')->path(),//retrieve file path

                        ]);

                    if($user){
                        
                       return redirect()->route('setting')->with('success',"Information has updated!");                        
                    }
                    else{
                        echo "data could not saved";
                        return redirect()->route('setting')->with('fail',"Information could not update!");
                       }


               }
               
               }

                 
            }            
        }
   

       
    }
//change password
    function changePassword(){
        return view('change_password');
    }  

    function updatePassword(Request $request){


        $this->validate($request, [
           'old_password' => 'required',
           'password' => 'required|min:6|confirmed',
           
            ]);

        $password= Auth::user()->password ."<br>";//get pass for current user
        if ( Hash::make($request->old_password) == Auth::user()->password) {
            echo "pass matched";
            exit;
            }


        else{
            $request->user()->fill([
                'password' => Hash::make($request->password)
            ])->save();  
            return redirect()->route('changePassword')->with('fail',"Password Changed!");

            }
            
        }

     function myProfile(){
        $title="My Profile";
        $id= Auth::id();
        $user= User::where('id', $id)
                     ->first(); 
        $locations= Regions::select('locations.*','issues.content','issues.severity','recomm.recommendation','recomm.initiatives')
                    ->leftJoin('locations','regions.location_id','=','locations.id')
                    ->leftJoin('issues','regions.id','=','issues.region_id')
                    ->leftJoin('recomm','issues.id','=','recomm.issue_id')
                    ->where('regions.user_id',$id)
                    ->get();                      
        $interest= InterestDatas::select('interestText.*')
                    ->join('interests','interests.interest_id','=','interestText.id')
                    ->where('interests.user_id', $id) 
                    ->get(); 
        return view('my_profile',['title'=>$title,'user'=>$user, 'interest'=>$interest,'locations'=>$locations]);
     }

    function gmap(){
        return view('test');

    }

    function markers(){
    $id= Auth::id();
    $dom = new \DOMDocument("1.0");
    $node = $dom->createElement("markers");
    $parnode = $dom->appendChild($node); 
    $q= Locations::select('locations.*')
            ->join('regions','regions.location_id','=','locations.id')
            ->where('regions.user_id',$id)
            ->get();
    if(count($q)>0){
            //header("Access-Control-Allow-Origin: *");
        foreach ($q as $key => $value) {

            $node = $dom->createElement("marker");
            $newnode = $parnode->appendChild($node);
            $newnode->setAttribute("id", $value->id);
            $newnode->setAttribute("location_name",$value->location_name);
            $newnode->setAttribute("location_level",$value->location_level);
            $newnode->setAttribute("lat",$value->lat);
            $newnode->setAttribute("lng",$value->lng);
            $newnode->setAttribute("parent_level",$value->parent_level);
            }   
    }
            return  response($dom->saveXML(),200)
                    ->header('Content-Type', 'text/xml');
    
    }
    
    function apiData(){

        $id= Auth::id();
//get data from api

        $interests= Interests::select('interestText.interest')
                    ->join('interestText','interestText.id','=','interests.interest_id')
                    ->where('interests.user_id',$id)
                    ->orderBy('interestText.id','desc')
                    ->get()
                    ->toArray();
        $regions= Regions::select('locations.location_name')
                    ->join('locations','locations.id','=','regions.location_id')
                    ->where('regions.user_id',$id)
                    ->orderBy('regions.id','desc')
                    ->get()
                    ->toArray();

        $r= array_flatten($regions);
        $i= array_flatten($interests);
        $finalArray= [
            'user_interests'=>$i,
            'user_regions'=>$r
        ];
        $json= json_encode($finalArray);
        $URL="http://ec2-52-32-196-57.us-west-2.compute.amazonaws.com/ocpu/library/WEattitudeAnalytx/R/sample.soln.skill.match.fun/json";

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
       
        $i=1;

        if(count($apiData)>0){
        foreach($apiData as $value){
            $sol= substr($value->Solution,0,40);
            $sol2= substr($value->Solution,40);
            $issue= substr($value->Issue_Addressed,0,40);
            $issue2= substr($value->Issue_Addressed,40);
            $est= substr($value->Estimated_Impact_of_Solution,0,40);
            $est2= substr($value->Estimated_Impact_of_Solution,40);
            $r=  substr($value->Skills_Required,0,40);
            $r2=  substr($value->Skills_Required,40);
            echo '
            <tr>
                <td>'.$i++.'</td>
                
                <td>'.$sol.' <span style="cursor:pointer;" data-toggle="collapse" data-target="#sol'.$i.'"><i class="fas fa-plus-circle"></i></span>
                    <span id="sol'.$i.'" class="collapse">'.$sol2.'</span>
                </td>
                
                <td>
                '.(strlen($value->Issue_Addressed)>40? "$issue<span style='cursor:pointer;' data-toggle='collapse' data-target='#issue'.$i.''><i class='fas fa-plus-circle'></i></span>
                    <span id='issue'.$i.'' class='collapse'>$issue2</span> " :"$value->Issue_Addressed").'
             
                
                </td> 
                
                <td>'.$value->Issue_Severity.'</td>
                <td>'.$value->Your_Skill_Match.'</td>
                
                <td>'.$r.' <span style="cursor:pointer;" data-toggle="collapse" data-target="#r'.$i.'"><i class="fas fa-plus-circle"></i></span>
                    <span id="r'.$i.'" class="collapse">'.$r2.'</span>
                </td>                 
                
                <td>'.$value->Match_Score.'</td>
                <td>'.$value->Region_Location.'</td>
                
                <td>'.$value->Estimated_Impact_of_Solution.'
                </td>                 
                
                <td>'.$value->Time_Required.'</td>
                <td width="25%">'.$value->Next_Steps_or_Resources.'</td>
                <td><input type="checkbox" name="tick"></input></td>

            </tr>
            ';
            }
        }
        else{
            echo "<tr>
                <td>No record found</td>
            </tr>";
        }
//get data from api end          
    }    
}
