
<!--sidebar menu for teacher start-->
       <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">

            <ul class="nav side-menu">
<?php 
  $role= Auth::user()->role;
  if($role===1):
?> 
                    <li>
                        <a href="{{route('home')}}"><i class="fas fa-th"></i> Dashboard </a>
    
                    </li>                    
                    <li>
                        <a href="{{route('public')}}" target="_blank"><i class="fas fa-home"></i> Homepage </a>
    
                    </li>
                <!--      
                  <li>
                    <a href="{{route('getInterest')}}"><i class="fas fa-map-marker-alt"></i> Interest </a>

                  </li>               
                  <li>
                    <a href="{{route('getLocations')}}"><i class="fas fa-map-marker-alt"></i> Region</a>
                  </li>                   

                  <li>
                    <a href=""><i class="fas fa-briefcase"></i> Issues</a>
                  </li>                  
                  <li>
                    <a href="{{route('getRecomm')}}"><i class="fas fa-clipboard-list"></i> Recomm / Ongoing Initiatives</a>
                  </li>                   
                -->
                  <li>
                    <a href="{{route('getVideos')}}"><i class="fas fa-clipboard-list"></i> Video / Essay</a>
                  </li>                    
                  <li>
                    <a class="text-uppercase" style="border-bottom:1px solid #e3e3e3;"><strong>Social Medai</strong></a>
                  </li>
                  <li>
                    <a href="#"><i class="fas fa-users"></i> Group</a>
                  </li>                   
                  <li>
                    <a href="#"><i class="fas fa-comment-alt"></i> Chat</a>
                  </li>                   
<?php else:?>


<?php endif?>                
    
              </ul>
             
              </div>


            </div>
<!--sidebar menu for teacher end-->
