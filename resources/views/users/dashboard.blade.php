@extends('admin.master')

@section('content')
        <div class="right_col" role="main">
    <!--flass message-->
    <div class="cleafix"></div>
      <div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
              <a class='close' data-dismiss='alert'>×</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif        
        @if(Session::has('success'))
            <div class="alert alert-success">
              <a class='close' data-dismiss='alert'>×</a>
                <h4>{!!Session::get('success')!!}</h4>
            </div>
        @endif        

        @if(Session::has('fail'))
            <div class="alert alert-danger">
                <h4>{!!Session::get('fail')!!}</h4>
            </div>
        @endif
        
      </div>  
      <!--end flass message-->          
          <!-- top tiles -->
          <div class="row tile_count">

            <div class="col-md-2 col-sm-4 col-xs-5 tile_stats_count" data-toggle="modal" data-target="#addSkills">
              <span class="count_top">Interest</span>
              <div class="count">123.50</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-5 tile_stats_count" data-toggle="modal" data-target="#addRegions">
              <span class="count_top"> Regions</span>
              <div class="count green">2,500</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-5 tile_stats_count" data-toggle="modal" data-target="#addIssues">
              <span class="count_top"> Issues</span>
              <div class="count">4,567</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-5 tile_stats_count" data-toggle="modal" data-target="#addRecommendations">
              <span class="count_top"> Recommendations</span>
              <div class="count">2,315</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-5 tile_stats_count" data-toggle="modal" data-target="#addInitiatives">
              <span class="count_top"> Ongoing Initiatives</span>
              <div class="count">7,325</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Network Activities <small>Graph title sub-title</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                  <div style="width: 100%;">
                    <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Top Campaign Performance</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Facebook Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Twitter Campaign</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Conventional Media</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Bill boards</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

          <div class="row">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Count of Requirement for Your Skills by Region</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <h4>App Usage across versions</h4>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.2</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>123k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.3</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>53k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.4</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>23k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.5</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>3k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget_summary">
                    <div class="w_left w_25">
                      <span>0.1.5.6</span>
                    </div>
                    <div class="w_center w_55">
                      <div class="progress">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </div>
                    <div class="w_right w_20">
                      <span>1k</span>
                    </div>
                    <div class="clearfix"></div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Ratio of Your Skills Required</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Top 5</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                          <p class="">Device</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                          <p class="">Progress</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>IOS </p>
                            </td>
                            <td>30%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Android </p>
                            </td>
                            <td>10%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Blackberry </p>
                            </td>
                            <td>20%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>Symbian </p>
                            </td>
                            <td>15%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Others </p>
                            </td>
                            <td>30%</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Questions you Might Have an Answer to</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <ul class="quick-list">
                      <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                      </li>
                      <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                      <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                      </li>
                      <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
                      </li>
                    </ul>

                    <div class="sidebar-widget">
                      <h4>Profile Completion</h4>
                      <canvas width="150" height="80" id="foo" class="" style="width: 160px; height: 100px;"></canvas>
                      <div class="goal-wrapper">
                        <span class="gauge-value pull-left">$</span>
                        <span id="gauge-text" class="gauge-value pull-left">3,200</span>
                        <span id="goal-text" class="goal-value pull-right">$5,000</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
<!--visitor location start-->
<div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Visitors location <small>geo-presentation</small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                          </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <div class="dashboard-widget-content">
                        <div class="col-md-4 hidden-small">
                          <h2 class="line_30">125.7k Views from 60 countries</h2>

                          <table class="countries_list">
                            <tbody>
                              <tr>
                                <td>United States</td>
                                <td class="fs15 fw700 text-right">33%</td>
                              </tr>
                              <tr>
                                <td>France</td>
                                <td class="fs15 fw700 text-right">27%</td>
                              </tr>
                              <tr>
                                <td>Germany</td>
                                <td class="fs15 fw700 text-right">16%</td>
                              </tr>
                              <tr>
                                <td>Spain</td>
                                <td class="fs15 fw700 text-right">11%</td>
                              </tr>
                              <tr>
                                <td>Britain</td>
                                <td class="fs15 fw700 text-right">10%</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;"></div>
                      </div>
                    </div>
                  </div>
                </div>
</div>
<!--visitor location end-->

<!--news feed start-->
<div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Your Social Media Feed</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>

                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Your Social Media Group Feed</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                              <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                          </h2>
                            <div class="byline">
                              <span>13 hours ago</span> by <a>Jane Smith</a>
                            </div>
                            <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                            </p>
                          </div>
                        </div>
                      </li>

                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!--recent activity end-->

            <!--skill and interest-->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Your Social Media Feed</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
        
                      <li>
                          <h4>Administrator</h4>
                      </li>                      
                      <li>
                          <h4>Social Media</h4>
                      </li>
                      <li>
                          <h4>Blogging</h4>
                      </li>                      
                      <li>
                          <h4>Video Creation</h4>
                      </li>                      
                      <li>
                          <h4>Financial Contribution</h4>
                      </li>

                    </ul>
                  </div>
                </div>
              </div>
              <!--to do list start-->
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>To Do List <small>Sample tasks</small></h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                          </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                      <div class="">
                        <ul class="to_do">
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Schedule meeting with new client </p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Create email address for new intern</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                          </li>
                          <li>
                            <p>
                              <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                          </li>

                        </ul>
                      </div>
                    </div>
                  </div>              
              <!--to do list end-->
            </div>            
            <!--skill and interest end-->
</div>
<!--news feed end-->

<!--sorting table-->
<div class="table-responsive">
<table class="table table-boredred">
  <thead>
    <th>
      <select class="form-control" name="sortBy">
        <option value="Sort By">
          Sort By
        </option>          
        <option value="Solution Impact">
          Solution Impact
        </option>        

        <option value="Solution Impact">
          Skill Match
        </option>
      </select>
    </th>    

    <th>
      <select class="form-control" name="region">
        <option value="Sort By">
          Region
        </option>          
        <option value="Solution Impact">
          Region One
        </option>        

        <option value="Solution Impact">
          Region Two
        </option>
      </select>
    </th>    

    <th>
      <select class="form-control" name="skill">
        <option value="">
          Skill Required
        </option>          
        <option value="Solution Impact">
          Skill One
        </option>        

        <option value="Solution Impact">
          Skill Two
        </option>
      </select>
    </th>
    <th>
      <select class="form-control" name="solution">
        <option value="">
          Solution
        </option>          
        <option value="Solution Impact">
          Solution One
        </option>        

        <option value="Solution Impact">
          Solution Two
        </option>
      </select>
    </th>
    <th>
      <select class="form-control" name="issue">
        <option value="">
          Issue One
        </option>          
        <option value="Solution Impact">
          Issue Two
        </option>        

        <option value="Solution Impact">
          Issue Three
        </option>
      </select>
    </th>
    <tbody>
      <tr>
        <td colspan="4"><button class="btn-primary btn">Click to find the best matches for your skill</button></td>
      </tr>
    </tbody>

  </thead>
</table>
</div>

<!--sorting table end-->
<div class="row">
  <div class="col-md-12 recomm_section">
    <div class="x_panel">
      <div class="x_title col-xs-10 pull-left">
        <h3><a data-toggle="collapse" data-target="#demo1">Lack of Access to Healthcare <span class=" pull-right"><i class="fas fa-map-marker"></i> Sudan</span></a></h3>
      </div>
      
    </div>
    <div class="x_content recomm_blue collapse" id="demo1">
      <h4>Issue Severity: <span class="wide-box"></span></h4>
      <div class="col-md-4 sorting-section" style="border-right:1px solid #e3e3e3">
          <h4 class="h4Title">Recommendation 1: </h4>
          <li>Type: Active</li>
          <li>Time Required: 1 Hour per week for 3 months</li>
      </div>

      <div class="col-md-4 sorting-section" style="border-right:1px solid #e3e3e3">
          <h4 class="h4Title">Recommendation 1: </h4>
          <li>Impact Score: <span class="box-rounded"></span></li>
          <li>Skill Match Score: <span class="box-rounded"></span></li>
      </div>      

      <div class="col-md-4 sorting-section">
          <li>Interest: 
            <label class="switch">
              <input type="checkbox">
              <span class="slider round"></span>
            </label>  
          </li>
          <li>Skill Match: Web Developer</li>
      </div>
      <div class="clearfix"></div>
      <!--recom text and skill-->
      <div class="recomm-text">
        <p>
          Increase public awareness of ways to avoid common diseases. Ultimate goal is to increase preventative healthcare to deal with preventable ailments; which make up the majority of health challenges.
        </p>
      </div>
      <div class="skill-required">
        <p>
          Skill Required: Video Creators, Brand Ambassadors, Models, Communications Expertise, Writers, Twitter, Instagram, Youtube
        </p> 
      </div>      
      <!--recom text and skill end-->
    </div>
  </div>
  <div class="col-md-12 recomm_section">
    <div class="x_panel">
      <div class="x_title col-xs-10 pull-left">
        <h3><a data-toggle="collapse" data-target="#demo2">Lack of Access to Healthcare <span class=" pull-right"><i class="fas fa-map-marker"></i> Sudan</span></a></h3>
      </div>
      
    </div>
    <div class="x_content recomm_blue collapse" id="demo2">
      <h4>Issue Severity: <span class="wide-box"></span></h4>
      <div class="col-md-4 sorting-section" style="border-right:1px solid #e3e3e3">
          <h4 class="h4Title">Recommendation 1: </h4>
          <li>Type: Active</li>
          <li>Time Required: 1 Hour per week for 3 months</li>
      </div>

      <div class="col-md-4 sorting-section" style="border-right:1px solid #e3e3e3">
          <h4 class="h4Title">Recommendation 1: </h4>
          <li>Impact Score: <span class="box-rounded"></span></li>
          <li>Skill Match Score: <span class="box-rounded"></span></li>
      </div>      

      <div class="col-md-4 sorting-section">
          <li>Interest: 
            <label class="switch">
              <input type="checkbox">
              <span class="slider round"></span>
            </label>  
          </li>
          <li>Skill Match: Web Developer</li>
      </div>
      <div class="clearfix"></div>
      <!--recom text and skill-->
      <div class="recomm-text">
        <p>
          Increase public awareness of ways to avoid common diseases. Ultimate goal is to increase preventative healthcare to deal with preventable ailments; which make up the majority of health challenges.
        </p>
      </div>
      <div class="skill-required">
        <p>
          Skill Required: Video Creators, Brand Ambassadors, Models, Communications Expertise, Writers, Twitter, Instagram, Youtube
        </p> 
      </div>      
      <!--recom text and skill end-->
    </div>
  </div>

</div>

<!--all modals-->
<!-- Modal for skills -->
<div class="modal fade" id="addSkills" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Skills Input</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('saveInterest')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
          <input type="hidden" name="type" value="skill">

                        <div class="demo">

                          <div class="form-group">
                            <label for="select-state">Select Interest/Hobby/Job</label>
                            <select id="select-state" name="interest[]" multiple class="demo-default"   placeholder="Type here...">
                              <option value="">Search Here...</option>
                                @forelse($interests as $value)
                                <option value="{{$value->id}}">{{$value->interest}}</option>
                                @empty

                                @endforelse
                            </select>
                          </div>
                          <script>
                          $('#select-state').selectize({
                            maxItems: 30
                          });
                          </script>
                        </div>
       
       
          <div class="form-group">
            <button type="submit" class="btn-default btn" id="save">Submit</button>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--modal for skills end-->  

<!-- Modal for addRegions -->
<div class="modal fade" id="addRegions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Regions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('saveLocation')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
          <h5>Indicate Regions you are most interested in:</h5>
          <div class="checkbox">
            <label>
              <input type="checkbox" onclick="" name="global" checked> All regions (Global)
            </label>
          </div>   
          <center><h3>OR</h3></center>            
          <div class="form-group">
            <label for="country">Select Regions that meet a certain criteria...</label>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="criteria" value="Issues" checked> Issues            
            </label>
          </div>           
          <div class="checkbox">
            <label>
              <input type="checkbox" name="criteria"  value="Recommendations"> Recommendations            
            </label>
          </div>           
          <div class="checkbox">
            <label>
              <input type="checkbox" name="criteria" value="Skills"> Skills            
            </label>
          </div>   
                        <div class="demo">
                          <div class="form-group">
                          
                            <select id="select-region" name="locations[]" multiple class="demo-default"   placeholder="Type here...(You can select multiple)">
                              <option value="">Type Here...(You can select multiple)</option>
                                @forelse($locations as $value)
                                <option value="{{$value->id}}">{{$value->location_name}}</option>
                                @empty

                                @endforelse
                            </select>
                          </div>
                          <script>
                          $('#select-region').selectize({
                            maxItems: 30
                          });
                          </script>
                        </div>

          </div>
                    
          <div class="form-group">
            <button type="submit" class="btn-primary btn" id="save">Submit</button>
          </div>
        </form>
        <div class="clearfix"></div>
        <center><h3>OR</h3></center>
<!--specific regions -->
        <form method="post" action="{{route('saveSpecificLocation')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

                        <div class="demo">
                          <div class="form-group">
                          
                            <select id="select-spec-region" name="locations[]" multiple class="demo-default"   placeholder="Type here...(You can select multiple)">
                              <option value="">Type Here...(You can select multiple)</option>
                                @forelse($locations as $value)
                                <option value="{{$value->id}}">{{$value->location_name}}</option>
                                @empty

                                @endforelse
                            </select>
                          </div>
                          <script>
                          $('#select-spec-region').selectize({
                            maxItems: 30
                          });
                          </script>
                        </div>
                  
          <div class="form-group">
            <button type="submit" class="btn-primary btn" id="save">Submit</button>
          </div>
        </form>        
<!--specific regions end-->        
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--modal for addRegions end-->

<!-- Modal for addIssues -->
<div class="modal fade" id="addIssues" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select regions to add issue</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('yourRegion')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
            
                        <div class="demo">
                          <div class="form-group">
                            <label>Select from your region</label>
                            <select id="user-region" name="userLocation[]" multiple class="demo-default"   placeholder="Type here...(You can select multiple)" required>
                              <option value="">Type Here...(You can select multiple)</option>
                                @forelse($userRegion as $ur)
                                <option value="{{$ur->location_id}}">{{$ur->location_name}}</option>
                                @empty
                                <option value="">No region found</option>
                                @endforelse
                            </select>
                          </div>
                          <script>
                          $('#user-region').selectize({
                            maxItems: 30
                          });
                          </script>
                        </div>
                    
          <div class="form-group">
            <button class="btn-primary btn" id="save">Next</button>
          </div>
        </form>
        <div class="clearfix"></div>
        <center><h3>OR</h3></center>
<!--specific regions -->
        <form method="post" action="{{route('specificRegion')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

                        <div class="demo">
                          <div class="form-group">
                            <label>Select specific regions</label>
                            <select id="all-region" name="locations[]" multiple class="demo-default"   placeholder="Type here...(You can select multiple)">
                              <option value="">Type Here...(You can select multiple)</option>
                                @forelse($locations as $value)
                                <option value="{{$value->id}}">{{$value->location_name}}</option>
                                @empty

                                @endforelse
                            </select>
                          </div>
                          <script>
                          $('#all-region').selectize({
                            maxItems: 30
                          });
                          </script>
                        </div>
                  
          <div class="form-group">
            <button class="btn-primary btn" id="save">Next</button>
          </div>
        </form>        
<!--specific regions end-->        
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--modal for addIssue end-->


<!-- Modal for addRecommendations -->
<div class="modal fade" id="addRecommendations" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Issue for Your Recommended Solution</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('getRecomm')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
            
                        <div class="demo">
                          <div class="form-group">
                            <label>Select From Issues You Listed</label>
                            <select id="user-issue" name="userIssue[]" multiple class="demo-default"   placeholder="Type here...(You can select multiple)" required>
                              <option value="">Type Here...(You can select multiple)</option>
                                @forelse($userIssue as $ui)
                                <option value="{{$ui->id}}">
                                  <?php echo substr($ui->content,0,100)."...";?>
                                </option>
                                @empty
                                <option value="">No issue found</option>
                                @endforelse
                            </select>
                          </div>
                          <script>
                          $('#user-issue').selectize({
                            maxItems: 30
                          });
                          </script>
                        </div>
                    
          <div class="form-group">
            <button type="submit" class="btn-primary btn" id="save">Next</button>
          </div>
        </form>
        <div class="clearfix"></div>
        <center><h3>OR</h3></center>
<!--specific regions -->
        <form method="post" action="{{route('specRecomm')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

                        <div class="demo">
                          <div class="form-group">
                            <label>Select specific regions</label>
                            <select id="all-region-issue" name="region_id[]" multiple class="demo-default"   placeholder="Type here...(You can select multiple)">
                              <option value="">Type Here...(You can select multiple)</option>
                                @forelse($locations as $value)
                                <option value="{{$value->id}}">{{$value->location_name}}</option>
                                @empty

                                @endforelse
                            </select>
                          </div>
                          <script>
                          $('#all-region-issue').selectize({
                            maxItems: 30
                          });
                          </script>
                        </div>          

          <div class="form-group">
            <label>Search specific issue</label>
            <select class="form-control" id="specIssueRes" name="issue_id">
              
              <input name="specific_issue" class="form-control" placeholder="Type here..." id="matchSpecIssue">
              
            </select>
            

            <span class="help-text" id="spec-issue-error"></span>
          </div>
                  
          <div class="form-group">
            <button href="{{route('saveSpecIssueRecomm')}}" class="btn-primary btn" id="specIssueBtn">Next</button>
          </div>
        </form>        
<!--specific regions end-->        
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--modal for addRecommendations end--> 

<!-- Modal for addInitiatives -->
<div class="modal fade" id="addInitiatives" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Solution Addressed by the Ongoing Initiative</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('saveLocation')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
            
                        <div class="demo">
                          <div class="form-group">
                            <label>Select From Solutions You Listed</label>
                            <select id="user-recomm" name="recomm_id[]" multiple class="demo-default"   placeholder="Type here...(You can select multiple)">
                              <option value="">Type Here...(You can select multiple)</option>
                                @forelse($userRecomm as $userR)
                                <option value="{{$value->id}}">{{$userR->recommendation}}</option>
                                @empty

                                @endforelse
                            </select> 
                          </div>
                          <script>
                          $('#user-recomm').selectize({
                            maxItems: 30
                          });
                          </script>
                        </div>   
                    
          <div class="form-group">
            <button type="submit" class="btn-primary btn" id="save">Next</button>
          </div>
        </form>
        <div class="clearfix"></div>
        <center><h3>OR</h3></center>
<!--specific regions -->
        <form method="post" action="{{route('saveLocation')}}" enctype="multipart/form-data">
              {{ csrf_field() }}

          <div class="form-group">
            <label>Select specific regions</label>
            <input class="form-control" onkeyup="getLocations()" id="search" placeholder="Type here...(you can select multiple)">
          </div>          

          <div class="form-group">
            <label>Select specific issues</label>
            <input class="form-control" onkeyup="getLocations()" id="search" placeholder="Type here...(you can select multiple)">
          </div>          

          <div class="form-group">
            <label>Select specific solutions</label>
            <input class="form-control" onkeyup="getLocations()" id="search" placeholder="Type here...(you can select multiple)">
          </div>
                  
          <div class="form-group">
            <a href="{{route('getInitiative')}}" class="btn-primary btn" id="save">Next</a>
          </div>
        </form>        
<!--specific regions end-->        
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--modal for addInitiatives end-->   
<!--all modals end-->
</div><!--right col end-->
@endsection

@section('js')
<script type="text/javascript">
  $("#matchSpecIssue").on("keyup", function(){
/*
    var region= $('#all-region-issue').selectize({
             onInitialize: function (selectize) {
                selectize.on('change', function (value) {
                     var item = this.$input[0];
                     var selected_text = $(item.selectize.getItem(value)[0]).text();
                  });
            }
     });
*/  
    var region=[];
        $.each($("#all-region-issue option:selected"), function(){            
            region.push($(this).val());
        });
    
    var content= $(this).val();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var dataString= {_token:CSRF_TOKEN,region:region,content:content};

      $.ajax({
          url:"<?php echo url('getissue-for-region')?>",
          type:"POST",
          data:dataString,
          dataType:"HTML",
          success:function(data){
            console.log(data);
            if(data=="false"){
              $("#spec-issue-error").html("Issue not found");
              $("#specIssueBtn").attr('disabled',true);

            }
            else{
              $('#specIssueRes').html(data);
              $("#spec-issue-error").empty();
              $("#specIssueBtn").attr('disabled',false);              
            }
          },
          error:function(){
              console.log("Error getting matched issue");
          }
      });
      
  })
</script>
@endsection