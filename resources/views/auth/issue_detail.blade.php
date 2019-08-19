<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>WEattitude | Issue Detail</title>
    <link href="{{url('public/css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" id="theme" type="text/css" href="{{url('public/css/homepage.css')}}"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script type="text/javascript"
        src="Access-Control-Allow-Origin: https://public.tableau.com/javascripts/api/tableau-2.min.js/"></script>
    <script type="text/javascript">
    //visual curve
        function initViz() {
            var containerDiv = document.getElementById("vizContainer"),
            url = "https://public.tableau.com/profile/n.a.8764#!/vizhome/WEattitudeSDMdemo12_27_18/Dashboard1";

            var viz = new tableau.Viz(containerDiv, url);
        }
  
    </script>     
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 450px;
      }
      /* Optional: Makes the sample page fill the window. */

    </style>
  </head>
<body onload="initViz();">
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
                                        <a href="{{route('writingVideos')}}"><i class="fas fa-video"></i> Daily Collections of Uplifiting Writings & Videos</a>
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
                                        @if(Auth::guest())
                                        <a href="{{url('login')}}"><i class="fas fa-undo-alt"></i> Here is What You Can do</a>
                                        @else
                                        <a href="{{route('myProfile')}}"><i class="fas fa-undo-alt"></i> Here is What You Can do</a>
                                        @endif
                                    </li>

                                    <li>
                                        <a href="{{route('caseStudy')}}"><i class="fas fa-search"></i> Case Studies / Success Stories</a>
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
<div class="clearfix"></div>
<div class="container otherpage" style="padding:30px;">
    <div class="hidden">
        <input id="lat" value="{{$recomm->lat}}">
        <input id="lng" value="{{$recomm->lng}}">
        <input id="title" value="{{$recomm->location_name}}">
    </div>
  <div class="row">
        <!--<h1 align="center" class="page-title" style="margin-bottom:50px">Issue Detail</h1>-->
        <div class="panel-default panel">
            <div class="panel-body">
                <div class="col-md-4">
                    <div class="panel-default">
                        
                        <div class="panel-body">
                            <div class="region bottom">
                                <h3><i class="fas fa-globe-africa" id="issue"></i> Region</h3>
                                <p>{{$recomm->location_name}}</p>
                            </div>
                            <div class="issue bottom">
                                <h3><i class="fas fa-table" id="issue"></i> Issue</h3>
                                <p>{{$recomm->content}}</p>
                            </div> 
                            <div class="severity bottom">
                                <span>
                                    <h3><i class="fas fa-exclamation-triangle" id="issue"></i> Issue Severity</h3> 
                        <?php 
                        $severity= $recomm->severity;
                        if($severity==''){
                            echo "<button class='btn btn-primary  btn-sm round-btn'>insufficient data</button>";
                        }
                        elseif($severity=="Hight"){
                            echo 
                            '
                            <button type="button" class="btn btn-warning  round-btn">'.$severity.'</button>
                            ';
                        }
                        elseif($severity=="Medium"){
                            echo 
                            '
                            <button type="button" class="btn btn-primary  round-btn">'.$severity.'</button>
                            ';                            
                        }
                        else{
                            echo 
                            '
                            <button type="button" class="btn btn-success  round-btn">'.$severity.'</button>
                            ';                              
                        }
                        ?>
                                </span>    
                            </div> 
                            
                            <div class="ranking bottom" style="border:1px solid #e3e3e3; background:#fce5d6;padding-left:10px; margin-bottom:20px;">
                                <h3><i id="issue" class="fas fa-filter"></i> Ranking of Issue Within Region</h3>
                            @forelse($otherIssue as $issue)
                            <p>
                                @if(!empty($issue->issue_ranking_within_region))
                                {{$issue->content}}: {{$issue->issue_ranking_within_region}}
                                

                                @endif
                            </p>
                            @empty()
                            <button class="btn-primary btn  btn-sm">insufficient data</button>
                            @endforelse
                            </div>
                            <div class="polarity bottom"style="border:1px solid #e3e3e3; background:#fce5d6;padding-left:10px;">
                                <h3><i id="issue" class="fas fa-filter"></i> Issue Popularity (Count of mentions)</h3>
                            @forelse($otherIssue as $issue)
                                
                                <p>{{$issue->content}}: {{$issue->issue_popularity_count}}</p>                            
                            @empty
                            <button class="btn-primary btn  btn-sm">insufficient data</button>
                            @endforelse
                            </div> 

                            

                            <div class="initiatives bottom">
                                <h3><i id="issue" class="fas fa-list-ul"></i> Initiatives</h3>
                                <p>
                                <?php if($recomm->initiatives==''){
                                    echo "<button class='btn btn-primary'>insufficient data</button>";
                                }
                                else{
                                    echo $recomm->initiatives;
                                }

                                ?>
                                </p>
                            </div> 
                            <div class="recomm bottom">
                                <h3><i id="issue" class="fas fa-clipboard-list"></i> Recommendation</h3>
                                <p>
                                <?php if($recomm->recommendation==''){
                                    echo "<button class='btn btn-primary'>insufficient data</button>";
                                }
                                else{
                                    echo $recomm->recommendation;
                                }

                                ?>
                                </p>
                            </div>                      
  
                        </div>
                    </div>
                </div><!--col-md-4 end-->

                <div class="col-md-8">
                    <div class="panel-default panel" style="margin-top:40px;">
                        
                        <div class="panel-body">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


  </div>
</div>

<div class="container">
    <div class="col-md-6" style="padding:0px; padding-right:10px; color:#808080;">
        <div class="panel-default panel">
            <div class="panel-heading"><h2>Solution / Recommendation</h2></div>
            <div class="panel-body">
                <div class="recomm-detail bottom">
                    <h3>Recommended Solution Description</h3>
                    <p class="bottom">{{$recomm->recommendation}}</p>
                    <span class="bottom"><h3>Estimated Impact of Solution</h3> 
                        <?php 
                        $recomm_cat= $recomm->recomm_impact_category;
                        if($severity==''){
                            echo "<button class='btn btn-primary  btn-sm round-btn'>insufficient data</button>";
                        }                        
                        elseif($recomm_cat=="Hight"){
                            echo 
                            '
                            <button type="button" class="btn btn-warning  round-btn">'.$recomm_cat.'</button>
                            ';
                        }
                        elseif($recomm_cat=="Medium"){
                            echo 
                            '
                            <button type="button" class="btn btn-primary  round-btn">'.$recomm_cat.'</button>
                            ';                            
                        }
                        else{
                            echo 
                            '
                            <button type="button" class="btn btn-success  round-btn">'.$recomm_cat.'</button>
                            ';                              
                        }
                        ?>
                        
                    </span>
                    <p class="bottom"style="padding-top:20px;"><h3>Impact Score:</h3> <button type="button" class="btn-primary btn round-btn  btn-sm"><?php if($recomm->recomm_impact_score==''){
                        echo "insufficient data";
                    }
                    else{
                    echo $recomm->recomm_impact_score."/100";
                    }
                    ?>
                    </button>
                    </p>
                    <div class="impact-detail alert alert-success bottom">
                        <h3>Impact Detail:</h3>
                        <p>{{$recomm->recommendation_detail}}</p>
                    </div>
                </div>

                <div id="vizContainer bottom">
                    <h3 style="font-size:14px;font-weight:700;">System Dynamic Model for Estimating Impact</h3>
                    <a href="https://public.tableau.com/profile/n.a.8764#!/vizhome/WEattitudeSDMdemo12_27_18/Dashboard1" target="_blank"><img class="img-responsive img-rounded" src="{{url('public/img/stakeholders.png')}}"/></a>

                </div>                
            </div>
        </div>

    </div>

    <div class="col-md-6" style="padding:0px;">
        <div class="panel-default panel">
            <div class="panel-heading"><h2>Skills / Resources Required</h2></div>
            <div class="panel-body">
                @forelse($skills as $skill)
                <p style="color:#808080;"><i class="<?= $skill->icon?>"></i> {{$skill->skills_required}}</p>
                @empty()
                @endforelse
            </div>            

        </div>        
        <div class="panel-default panel">
            <div class="panel-heading"><h2>Ongoing Initiatives / Organizations Tackling Issue</h2></div>
            <div class="panel-body">
                <div class="alert-success alert">
                    <h3 style="font-size:14px;font-weight:700;">Ongoing Initiatives Details:</h3>
                    <p>{{$recomm->ongoing_initiatives_detail}}</p>
                </div>
                <div class="initiatives">
                    
                    <button type="button" class="btn-default btn  btn-sm">
                        <?php 
                            $init= $recomm->initiatives;
                            if($init==''){
                                echo "insufficient data";
                            }
                            else{
                                echo $init;
                            }
                        ?>
                        
                    </button>
                </div>
            </div>            

        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="table-responsive" style="padding:15px;">
            <table class="table-bordered table">
                <thead>
                    <tr>
                        
                        <th>Solution / Recommendation</th>
                        <th>Popularity (Count of Mentions)</th>
                        <th>Impact Score</th>
                        <th>Estimate Impact of Solutions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($otherRecomm as $recomm)
                    <tr>
                        
                        <td>{{$recomm->recommendation}}</td>
                        <td>
                            <button class="btn-primary btn round-btn btn-sm">
                                <?php 
                                    if($recomm->recomm_popularity_count==''){
                                        echo "insufficient data";
                                    }
                                    else{
                                        echo $recomm->recomm_popularity_count;
                                    }
                                ?>
                                
                            </button>
                        </td>
                        <td>
                            <button class="btn-default btn round-btn  btn-sm">
                            <?php 
                            if($recomm->recomm_impact_score==''){
                                echo "insufficient data";
                            }
                            else{
                                echo $recomm->recomm_impact_score;
                            }
                            ?>
                            </button>
                        </td>
                        <td>
                            <?php 
                                $cat= $recomm->recomm_impact_category;
                                if($cat==''){
                                    echo '<button class="btn btn-warning round-btn  btn-sm">insufficient data</button> ';                                    
                                }
                                elseif($cat=="High"){
                                    echo '<button class="btn btn-warning round-btn">'.$cat.'</button> ';
                                }
                                elseif($cat=="Medium"){
                                    echo '<button class="btn btn-primary round-btn">'.$cat.'</button> ';                                    
                                }
                                else{
                                    echo '<button class="btn btn-success round-btn">'.$cat.'</button> ';                                     
                                }
                            ?>
                        </td>
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
<div class="clearfix"></div>
        <div class="container-fluid footer" style="margin-top:100px;">
            <strong><center>&copy; All Rights Reserved | weattitude.org</center> </strong>
        </div>
    <script src="{{url('public/js/2.1.4-jquery.js')}}"></script>
    <script src="{{url('public/js/app.js')}}"></script> 
    <script>

    var lat = parseFloat(document.getElementById('lat').value);
    var lng = parseFloat(document.getElementById('lng').value);
    var title = document.getElementById('title').value;
                //var lng= $('[name="lng"]').val();
                
                function initMap() {
                var myLatLng = {lat: lat, lng: lng};

                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 8,
                  center: new google.maps.LatLng(lat, lng)
                });

                var marker = new google.maps.Marker({
                  position: myLatLng,
                  map: map,
                  title: title
                });
              }

    </script>
   
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgB7vF_nyTAIBpEyHUjtE0bzNXoTNrqcc&callback=initMap">
    </script>

  </body>
</html>