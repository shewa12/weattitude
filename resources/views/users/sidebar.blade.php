
<!--sidebar menu for teacher start-->
       <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">

            <ul class="nav side-menu">
<?php 
  $role= Auth::user()->role;
  if($role===1):
?> 
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
                    <a href="{{route('getIssues')}}"><i class="fas fa-briefcase"></i> Issues</a>
                  </li>                  
                  <li>
                    <a href="{{route('getRecomm')}}"><i class="fas fa-clipboard-list"></i> Recomm / Ongoing Initiatives</a>
                  </li>                   
                -->
                  <li>
                    <a href="{{route('getVideos')}}"><i class="fas fa-clipboard-list"></i> Video / Essay</a>
                  </li>                    
                  <span>Social Medai</span>
                  <li>
                    <a href="#"><i class="fas fa-users"></i> Group</a>
                  </li>                   
                  <li>
                    <a href="#"><i class="fas fa-message"></i> Chat</a>
                  </li>                   
<?php else:?>
                  <li>
                    <a href="{{route('calendar')}}"><i class="fas fa-map-marker-alt"></i> Calendar</a>
                  </li>
                  <li><a href="{{route('users')}}"><i class="fas fa-user-alt"></i> Technician</a>
                  </li>
                  <li><a href="{{route('appUsers')}}"><i class="fas fa-users"></i> Users</a>
                  </li>

<?php endif?>                
    
              </ul>
             
              </div>


            </div>
<!--sidebar menu for teacher end-->
