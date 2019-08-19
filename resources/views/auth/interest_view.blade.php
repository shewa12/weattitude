@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div id="map_canvas" style="width:100%; height:100%"></div>
    </div>
	<div class="row" style="margin-top:50px;">
			<h1 class="page-title">Your Interest Matched</h1>
            <div id="map"></div>
            <div class='table-responsive'>
                <table class='table table-border'>
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            
                            <th>Solution</th>
                            <th>Issue_Severity</th>
                            <th>Your Skill Match</th>
                            <th>Skills Required</th>
                            <th>Match Score</th>
                            <th>Region Location</th>
                            <th>Estimated Impact of Solution</th>
                            <th>Time Required</th>
                            <th>Next Steps or Resources</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                    <?php $i= 1;?>
                    @forelse($solutions as $key=> $value)	
		                <tr>
		                    <td>{{$i++}}</td>
                            <td>{{$value->Solution}}</td>
		                    
		                    <td>{{$value->Issue_Severity}}</td>
		                    <td>{{$value->Your_Skill_Match}}</td>
                            <td>{{$value->Skills_Required}}</td>
                            <td>{{$value->Match_Score}}</td>
                            <td>{{$value->Region_Location}}</td>
                            <td>{{$value->Estimated_Impact_of_Solution}}</td>
                            <td>{{$value->Time_Required}}</td>
		                    <td>{{$value->Next_Steps_or_Resources}}</td>
		                </tr>
		            @empty
		            <tr>
		            	<td>No record found</td>
		            </tr>    
		            @endforelse
                    </tbody>
                </table>
                <a class="btn-default btn" href="{{route('public')}}">Back</a>
            </div>   
@inject('marker', 'admin\Http\Controllers\VisitorsCtrl')
<?php 
//$marker::interestMarker($mapInfo);
    //url('/interest-markers/'.$mapInfo);
?>         
                
	</div>
</div>
@endsection

@section('js')
    
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDgB7vF_nyTAIBpEyHUjtE0bzNXoTNrqcc&sensor=true">
    </script>
    <script type="text/javascript">
      var map;
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(58, 16),
          zoom: 7,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
      }
    </script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>       
    <script type="text/javascript">
// https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false
// //code.jquery.com/jquery-1.11.0.min.js

var map;

// The JSON data
var json = [{"id":48,"title":"Helgelandskysten","longitude":"12.63376","latitude":"66.02219"},{"id":46,"title":"Tysfjord","longitude":"16.50279","latitude":"68.03515"},{"id":44,"title":"Sledehunds-ekspedisjon","longitude":"7.53744","latitude":"60.08929"},{"id":43,"title":"Amundsens sydpolferd","longitude":"11.38411","latitude":"62.57481"},{"id":39,"title":"Vikingtokt","longitude":"6.96781","latitude":"60.96335"},{"id":6,"title":"Tungtvann- sabotasjen","longitude":"8.49139","latitude":"59.87111"}];



function initialize() {
  
  // Giving the map som options
  var mapOptions = {
    zoom: 4,
    center: new google.maps.LatLng(66.02219,12.63376)
  };
  
  // Creating the map
  map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
  
  
  // Looping through all the entries from the JSON data
  for(var i = 0; i < json.length; i++) {
    
    // Current object
    var obj = json[i];

    // Adding a new marker for the object
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(obj.latitude,obj.longitude),
      map: map,
      title: obj.title // this works, giving the marker a title with the correct title
    });
    
    // Adding a new info window for the object
    var clicker = addClicker(marker, obj.title);

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
@endsection