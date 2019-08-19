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

    <link rel="stylesheet" href="{{url('/public/selectize/selectize.bootstrap3.css')}}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{url('public/css/custom.css')}}">
  
    <link rel="stylesheet" id="theme" type="text/css" href="{{url('public/css/homepage.css')}}"/>

   
    <!--slider css-->
    <link rel="stylesheet" id="theme" type="text/css" href="{{url('public/slider/css/default.css')}}"/>
    <link rel="stylesheet" id="theme" type="text/css" href="{{url('public/slider/css/component.css')}}"/>
    <script type="text/javascript" src="{{url('public/slider/js/modernizr.custom.js')}}"></script>
<!--slider css end-->
<!--selectize assets-->
    <script src="{{url('/public/selectize/jquery.min.js')}}"></script>
    <script src="{{url('/public/selectize/selectize.js')}}"></script>
<!--selectize assets end--> 
<style type="text/css">
    .footer{position: fixed;bottom: 0;left: 0;right: 0;}
    img {width: 30%;}
</style>
  
  
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
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

        @yield('content')
<div class="clearfix"></div>
        <div class="container-fluid footer">
            <strong><center>&copy; All Rights Reserved | WEattitude.org</center> </strong>
        </div>
    </div>

    <!-- Scripts -->
  
    <script src="{{url('public/js/2.1.4-jquery.js')}}"></script>
    <script src="{{url('public/js/app.js')}}"></script>
    
    <!--bootstrap tags js-->
    
    <script src="https://unpkg.com/ionicons@4.0.0/dist/ionicons.js"></script> 
<!--slider js -->
        <script src="{{url('public/slider/js/jquery.imagesloaded.min.js')}}"></script>
        <script src="{{url('public/slider/js/cbpBGSlideshow.min.js')}}"></script>
        <script>
            $(function() {
                cbpBGSlideshow.init();
            });
        </script>    
<!--slider js end-->    
    <!--js area-->
    @yield('js')
    <!--js area end-->  
</body>

</html>
