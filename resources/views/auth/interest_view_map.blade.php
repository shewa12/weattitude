<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WEattitude  <?php if(!empty($title)){
        echo "|" .$title;
    }?></title>

    <!-- Styles -->
    <link href="{{url('public/css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" id="theme" type="text/css" href="{{url('public/css/homepage.css')}}"/>
    <!--bootstrap tags css-->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100% }
    </style>
 
  </head>

  <body onload="initialize()">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        WEattitude.org
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if(Auth::guest())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    YOURattitude <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/login') }}">Login</a></li>
                                    <li><a href="{{ url('/register') }}">Register</a></li>

                                </ul>
                            </li>
                        @else
                            <li><a href="{{route('home')}}">YOURattitude</a></li>
                        @endif
                            
                            <li><a href="{{route('aboutUs')}}">About Us</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Motivation Resources
                                     <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        
                                        <a href="{{route('hangoutSheet')}}"><i class="fas fa-folder-open"></i> Handout Sheet for Your Community</a>
                                    </li>                                     
                                    <li>  
                                        <a href="{{route('writingVideos')}}"><i class="fas fa-video"></i> Daily Collections of Uplifting Writings & Videos</a>
                                    </li>                                     
                                    <li>

                                        <a href="{{route('whyParticipate')}}"><i class="fas fa-undo-alt"></i> What do Participants Get in Return </a>
                                    </li> 
                                </ul>  
                            </li>              
                            <li class='dropdown'>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ongoing Initiatives <span class="caret"></span></a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{route('issueSuggestedSolution')}}"><i class="fas fa-check-circle"></i>
                                            Issues & Suggested Solutions
                                        </a>
                                    </li>

                                    <li>
                                        <a href=""><i class="fas fa-undo-alt"></i> Here is What You Can do</a>
                                    </li>

                                    <li>
                                        <a href="{{route('caseStudy')}}"><i class="fas fa-search"></i> Case Studies/ Success Stores</a>
                                    </li>
                                </ul>
                            </li>
                                                
                        @if (Auth::guest())
                       
                        @else

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{route('setting')}}">Setting</a>
                                    </li> <!--                         
                                    <li>
                                    <a href="{{route('changePassword')}}">Change Password</a>
                                    </li>                         -->           
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

<div class="container">
    

  <div class="row" style="margin-top:50px;">
        <div class="col-md-3 info" style="margin-top:27px;">
            <div class="panel-default panel">
                <div class="panel-body">
                    <a href="{{url('register')}}">
                        Create a free account to save your profile, enter your custom regions, receive notification and much more...
                    </a>
                </div>
            </div>            

            <div class="panel-default panel">
                <div class="panel-heading">
                    <h3 align="center"> Your Interest/ Hobbies / Skills</h3>
                </div>
                <div class="panel-body interest">
                    <?php 
                        $n= count($interests); 
                        if($n>0){
                        for($i=0; $i<$n; $i++){
                            $interest= $interests[$i];
                            echo 
                            "
                            <p><strong><i class='fas fa-smile hobby-icon'></i> $interest</strong></p>
                            ";
                        }
                        }

                        ?>
                </div>
            </div>
        </div>

    <div class="col-md-9">
      <h1 class="page-title">Your Interest Matched</h1>
            <div id="map_canvas" style="width:100%; height:450px"></div>
  
    </div>  
    <div class="cleafix"></div>

  </div>   <!--row end-->
    <div class="row">
            <div class='table-responsive'>
                <table class='table table-border'>
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            
                            <th>Solution</th>
                            <th>Issue Addressed</th>
                            <th>Issue_Severity</th>
                            <th>Your Skill Match</th>
                            <th>Skills Required</th>
                            <th>Match Score</th>
                            <th>Region Location</th>
                            <th>Estimated Impact of Solution</th>
                            <th>Time Required</th>
                            <th>Next Steps or Resources</th>
                            <th>Interested?</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                    <?php $i= 1;?>
                    @forelse($solutions as $key=> $value) 
                    <tr>
                        <td>{{$i++}}</td>
                            <td>{{$value->Solution}}</td>
                            <td>{{$value->Issue_Addressed}}</td>
                        <td>{{$value->Issue_Severity}}</td>
                        <td>{{$value->Your_Skill_Match}}</td>
                            <td>{{$value->Skills_Required}}</td>
                            <td>{{$value->Match_Score}}</td>
                            <td>{{$value->Region_Location}}</td>
                            <td>{{$value->Estimated_Impact_of_Solution}}</td>
                            <td>{{$value->Time_Required}}</td>
                        <td>{{$value->Next_Steps_or_Resources}}</td>
                        <td>
                            <input type="checkbox" class="form-control" value="1"></input>
                        </td>
                    </tr>
                @empty
                <tr>
                  <td>No record found</td>
                </tr>    
                @endforelse
                    </tbody>
                </table>
                <center>
                    <a class="btn-primary btn" href="{{url('/register')}}">Sign Up</a>
                    <a class="btn-primary btn" href="{{route('caseStudy')}}">See Success Stories</a>
                    <a class="btn-primary btn" href="{{route('aboutUs')}}">Learn More</a>
                </center>
            </div> 
    </div>    
<!--table end-->     
</div>
<div class="container-fluid footer" style="margin-top:50px;">
    <strong><center>&copy; All Rights Reserved | WEattitude.org</center> </strong>
</div>
  <?php
  
      $json= json_encode($mapInfo);
      echo "<input type='hidden' name='mapData' value='$json'/>";
      
  ?>    
<!--table--> 
   
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDgB7vF_nyTAIBpEyHUjtE0bzNXoTNrqcc&sensor=true">
    </script>
    <script type="text/javascript">
      var map;
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(58, 16),
          zoom: 4,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
      }
    </script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>  
    <script src="{{url('public/js/app.js')}}"></script>         
    <script type="text/javascript">
// https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false
// //code.jquery.com/jquery-1.11.0.min.js

var map;

var myJson= $('[name="mapData"]').val();
var json=  JSON.parse(myJson);

//var json = [{"id":48,"title":"Helgelandskysten","longitude":"12.63376","latitude":"66.02219"},{"id":46,"title":"Tysfjord","longitude":"16.50279","latitude":"68.03515"},{"id":44,"title":"Sledehunds-ekspedisjon","longitude":"7.53744","latitude":"60.08929"},{"id":43,"title":"Amundsens sydpolferd","longitude":"11.38411","latitude":"62.57481"},{"id":39,"title":"Vikingtokt","longitude":"6.96781","latitude":"60.96335"},{"id":6,"title":"Tungtvann- sabotasjen","longitude":"8.49139","latitude":"59.87111"}];

function initialize() {
  
  // Giving the map some options
    var mapOptions = {
    center: new google.maps.LatLng(66.02219,12.63376)
  };
  
  // Creating the map
  map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
  var latlngbounds = new google.maps.LatLngBounds();
  
  // Looping through all the entries from the JSON data
  for(var i = 0; i < json.length; i++) {
    
    // Current object
    var obj = json[i];
    //alert(obj);
    // Adding a new marker for the object
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(obj.loc_lat,obj.loc_lon),
      map: map,
      title: obj.loc_name //this works, giving the marker a title with the correct title
    });

    latlngbounds.extend(new google.maps.LatLng(obj.loc_lat,obj.loc_lon));
    map.fitBounds(latlngbounds);     
    // Adding a new info window for the object
    var clicker = addClicker(marker, obj.loc_name);

  } // end loop
  
  
  // Adding a new click event listener for the object
  function addClicker(marker, content) {
    google.maps.event.addListener(marker, 'click', function() {
      
      if (infowindow) {infowindow.close();}
      infowindow = new google.maps.InfoWindow({content: content});
      infowindow.open(map, marker);
      
    });
  }

}

// Initialize the map
google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </body>
</html>