<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>My Profile</title>
    <!-- Styles -->
    <link href="{{url('public/css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{url('public/css/custom.css')}}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous"> 
    <script src="{{url('public/js/2.1.4-jquery.js')}}"></script>
    <script src="{{url('public/js/app.js')}}"></script>       
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
      	height:450px;
      } 
      #loading{
          display:none;
      }
      #table{
          display:none;
      }
    </style>
  </head>

<body>
  <div id="app">
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
                        @if (Auth::guest())
                        
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                       
                        @else
                        <li>
                            <a href="{{route('home')}}">Dashboard</a>
                        </li>
                        <li>
                            <a href="{{route('myProfile')}}">My Profile</a>

                        </li>
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
  </div>
  <div class="container">
    <div class="row">
        <div class="col-md-3 info">
            <div class="panel-default panel">
                <div class="panel-body">
                  <center>
                    <img class="img-responsive img-thumbnail" src="{{url('storage/app/avatars').'/'.$user->image}}" style="width:120px;height:120px;border-radius:60px;"/>
                    <h3>{{$user->name}}</h3>
                    </center>
                </div>
            </div>            

            <div class="panel-default panel">
                <div class="panel-heading">
                    <h3 align="center"> Your Interest/ Hobbies / Skills</h3>
                </div>
                <div class="panel-body interest">
                    @forelse($interest as $value)
                        @if($value->type=="Job Role")
                      <p><strong><i class="fas fa-briefcase job-icon"></i> {{$value->interest}}</strong></p>
                        @elseif($value->type=="Skill")
                      <p><strong><i class="fas fa-check-circle skill-icon"></i> {{$value->interest}}</strong></p>
                        @elseif($value->type=="Hobby")
                      <p><strong><i class="fas fa-smile hobby-icon"></i> {{$value->interest}}</strong></p>
                        @else
                      <p><strong><i class="fas fa-th custom-icon"></i> {{$value->interest}}</strong></p>

                      @endif
                    @empty
                    <strong>No record found</strong>
                    @endforelse  
                </div>
            </div>
        </div>

        <!--gmap-->

        <div class="col-md-9">
            <h3 style="margin-top:0px;">Your Regions of Interest</h3>

            <div id="map"></div>
            <!--location name-->
            <div class="panel-default panel">
                <div class="panel-heading">
                    <div data-toggle="collapse" data-target="#demo" style="cursor:pointer; font-weight:bold; font-size:15px;">Click here to see your regions</div>

                </div>
                <div class="panel-body collapse" id="demo">
                      <ul>
                        @forelse($locations as $value)
                          <li>{{$value->location_name}}</li>
                        @empty()
                        <li>No record found</li>
                        @endforelse
                      </ul>    
                   
                </div>
            </div>
            <!--location name end-->

        </div>
        <!--gmap end-->
    </div>
  </div>

  <!--summary table-->
<div class="container">
  <div class="row">
      

      <div class="table-responsive">
          <h3>Issues & Recommendations You Mentioned</h3>
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>Sl No:</th>
                      <th>Regions</th>
                      <th>Issues</th>
                      <th>Recommendation</th>
                      <th>Initiatives</th>
                      <th>Severity</th>
                  </tr>
              </thead>

              <tbody>
                <?php $i=1;?>
                @forelse($locations as $value)
                  <tr>
                      <td>{{$i++}}</td>
                      <td>{{$value->location_name}}</td>
                      <td>{{$value->content}}</td>
                      <td>{{$value->recommendation}}</td>
                      <td>{{$value->initiatives}}</td>
                      <td>{{$value->severity}}</td>
                  </tr>
                @empty()
                <tr>
                  <td>No record found</td>
                </tr>  
                @endforelse
              </tbody>
          </table>
      </div>
  </div>
</div>
  <!--summary table end-->
<!--api data-->
<div class="container" style="margin-bottom:50px;">
    
  <div class="row">
      <button class="btn btn-primary btn-lg" id="api">Click to Find The Best Matches for Your Skills <i  class="fas fa-spinner fa-spin" id="loading" style="padding-left:15px;"></i></button>

    <div class="table-responsive " id="table">
        <h3>Issues & Solutions That Specifically Need Your Skills</h3>

    <table class="table table-striped">
      <thead>
        <tr>
            <th>Sl No:</th>
            
            <th>Solution</th>
            <th>Issue Addressed</th>
            <th>Severity</th>
            <th>Your Skill Match</th>
            <th width="25%">Skills Required</th>
            <th>Match Score</th>
            <th>Region_Location</th>
            <th width="25%">Estimated Impact of Solution</th>
            <th>Time Required</th>
            <th width="20%">Next Steps or Resources</th>
            <th>Interested?</th>
        </tr>
      </thead>
      <tbody id="result">

      </tbody>
    </table>  
    </div>
  </div>
</div>
<!--api data end-->
    <script>
      var content;
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(23.684994, 90.356331),
          zoom: 7
        });
        // latlngbounds = new google.maps.LatLngBounds();
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file

          downloadUrl("<?php echo url('/markers')?>", function(data) {

            var xml = data.responseXML;
            
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var title = markerElem.getAttribute('location_name');
              var address = markerElem.getAttribute('location_level');
              var type = markerElem.getAttribute('parent_level');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));
              
              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = title
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label,
                animation: google.maps.Animation.DROP
              });
//bounds start

             // latlngbounds.extend(point);
              //map.fitBounds(latlngbounds); 

//bounds end              
              marker.addListener('click', function() {

                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);

              });

            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgB7vF_nyTAIBpEyHUjtE0bzNXoTNrqcc&callback=initMap">
    </script>

<!--api data script--> 
<script type="text/javascript">
  $(document).ready(function(){
        $("#api").click(function(){
           
    $.ajax({
        url:"<?php echo url('api-data')?>",
        type:"GET",
        dataType:"HTML",
        beforeSend:function(){
            $("#loading").show();
             //$("#result").load(location.href+ " #result");
        },
        success:function(data){
            $("#loading").hide();
            $("#table").show();
            
            $("#result").html(data);
            
        },
        error:function(){
          alert("error");
        }
    });            
            
        });
  });
  

</script>   
<!--api data script end-->   

  </body>
</html>