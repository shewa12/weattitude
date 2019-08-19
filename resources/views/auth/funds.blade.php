@extends('layouts.app')

@section('content')
<div class="cointainer otherpage-area">
	<div class="row">
		<div class="col-md-8 col-md-offset-2" style="margin-bottom:100px;">
			<h1 align="center" class="page-title">Funds – Inflow and Outflow
			</h1>
			<div class="content">
				<p align="center">
					Financial transparency is at the core of the WEattitude.org philosophy. Monthly details of inflow and outflow of finances are made publicly available.

				</p>
			</div>
		</div>

	</div>


</div>

<!--graph -->
<div class="container">
	<div class="row" style="padding:0px;margin-top:50px;">
		<!--inflow-->
            <div class="col-md-6 col-sm-6 col-xs-12 graph-circle">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h2>INFLOW</h2>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                  <table class="table table-bordered" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Top 5</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                          <p class="">Funds Type</p>
                        </div>

                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="table table-bordered">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Donatinos </p>
                            </td>
                           
                          </tr>

                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Paid Service </p>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Ads Revenue </p>
                            </td>
                            
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($inflows as $value)

                          <tr>
                            <td>{{$value->description}}</td>
                            <td>{{$value->created_at}}</td>
                            <td>{{$value->amount}}</td>
                          </tr> 
                          @empty
                          <tr>
                            <td>No record found</td>
                          </tr>
                          @endforelse
                        </tbody>
                    </table>
                  </table>
                  </div>
                </div>
              </div>
            </div>
        <!--inflow end-->
<!--out flow--> 
            <div class="col-md-6 col-sm-6 col-xs-12 graph-circle">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h2>OUTFLOW</h2>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                  <table class="table table-bordered" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Top 5</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                          <p class="">Funds Type</p>
                        </div>

                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas id="canvas2" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="table table-bordered">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>Donatinos </p>
                            </td>
                           
                          </tr>

                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>Paid Service </p>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Ads Revenue </p>
                            </td>
                            
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($outflows as $value)
                          
                          <tr>
                            <td>{{$value->description}}</td>
                            <td>{{$value->created_at}}</td>
                            <td>{{$value->amount}}</td>
                          </tr> 
                          @empty
                          <tr>
                            <td>No record found</td>
                          </tr>
                          @endforelse
                        </tbody>
                    </table>                    
                  </table>
                  </div>
                </div>
              </div>
            </div>        
<!--out flow end-->           
	</div>

<!--wave graph-->  
<div class="row">
    <div class="panel-default panel" style="padding:0px;">
        <div class="panel-heading"><h2>Inflow VS Outflow</h2></div>

        <div class="panel-body">
            <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
            <div style="width: 100%;">
              <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;">
            </div>
    </div>
        </div>
    </div>

</div>
<!--wave graph end-->  
</div>
<!--graph end-->



@endsection

@section('js')
    <!-- FastClick -->

    @yield('js')
    <script src="{{url('public/admin/js/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{url('public/admin/js/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{url('public/admin/js/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{url('public/admin/js/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{url('public/admin/js/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{url('public/admin/js/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{url('public/admin/js/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{url('public/admin/js/jquery.flot.js')}}"></script>
    <script src="{{url('public/admin/js/jquery.flot.pie.js')}}"></script>
    <script src="{{url('public/admin/js/jquery.flot.time.js')}}"></script>
    <script src="{{url('public/admin/js/jquery.flot.stack.js')}}"></script>
    <script src="{{url('public/admin/js/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{url('public/admin/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{url('public/admin/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{url('public/admin/js/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{url('public/admin/js/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{url('public/admin/js/jquery.vmap.js')}}"></script>
    <script src="{{url('public/admin/js/jquery.vmap.world.js')}}"></script>
    <script src="{{url('public/admin/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{url('public/admin/js/moment.min.js')}}"></script>
    <script src="{{url('public/admin/js/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{url('public/admin/js/custom.min.js')}}"></script>

    @yield('js')
    <!-- Flot -->
    <script>
      $(document).ready(function() {
        var data1 = [
          [gd(2012, 1, 1), 17],
          [gd(2012, 1, 2), 74],
          [gd(2012, 1, 3), 6],
          [gd(2012, 1, 4), 39],
          [gd(2012, 1, 5), 20],
          [gd(2012, 1, 6), 85],
          [gd(2012, 1, 7), 7]
        ];

        var data2 = [
          [gd(2012, 1, 1), 82],
          [gd(2012, 1, 2), 23],
          [gd(2012, 1, 3), 66],
          [gd(2012, 1, 4), 9],
          [gd(2012, 1, 5), 119],
          [gd(2012, 1, 6), 6],
          [gd(2012, 1, 7), 9]
        ];
        $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
          data1, data2
        ], {
          series: {
            lines: {
              show: false,
              fill: true
            },
            splines: {
              show: true,
              tension: 0.4,
              lineWidth: 1,
              fill: 0.4
            },
            points: {
              radius: 0,
              show: true
            },
            shadowSize: 2
          },
          grid: {
            verticalLines: true,
            hoverable: true,
            clickable: true,
            tickColor: "#d5d5d5",
            borderWidth: 1,
            color: '#fff'
          },
          colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
          xaxis: {
            tickColor: "rgba(51, 51, 51, 0.06)",
            mode: "time",
            tickSize: [1, "day"],
            //tickLength: 10,
            axisLabel: "Date",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 10
          },
          yaxis: {
            ticks: 8,
            tickColor: "rgba(51, 51, 51, 0.06)",
          },
          tooltip: false
        });

        function gd(year, month, day) {
          return new Date(year, month - 1, day).getTime();
        }
      });
    </script>
    <!-- /Flot -->

    <!-- JQVMap -->
    <script>
      $(document).ready(function(){
        $('#world-map-gdp').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#666666',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#E6F2F0', '#149B7E'],
            normalizeFunction: 'polynomial'
        });
      });
    </script>
    <!-- /JQVMap -->

    <!-- Skycons -->
    <script>
      $(document).ready(function() {
        var icons = new Skycons({
            "color": "#73879C"
          }),
          list = [
            "clear-day", "clear-night", "partly-cloudy-day",
            "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
            "fog"
          ],
          i;

        for (i = list.length; i--;)
          icons.set(list[i], list[i]);

        icons.play();
      });
    </script>
    <!-- /Skycons -->

    <!-- Doughnut Chart -->
    <script>
      $(document).ready(function(){
        var options = {
          legend: false,
          responsive: false
        };

        new Chart(document.getElementById("canvas1"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Ads Revenue",
              "Donations",
              "Paid Services"
            ],
            datasets: [{
              data: [30, 30, 30],
              backgroundColor: [
                "#49a9ea",
                "#9B59B6",
                "#E74C3C"

              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F"

              ]
            }]
          },
          options: options
        });
      });

      $(document).ready(function(){
        var options = {
          legend: false,
          responsive: false
        };

        new Chart(document.getElementById("canvas2"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Ads Revenue",
              "Donations",
              "Paid Services"
            ],
            datasets: [{
              data: [30, 30, 30],
              backgroundColor: [
                "#49a9ea",
                "#9B59B6",
                "#E74C3C"

              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F"

              ]
            }]
          },
          options: options
        });

      });      
    </script>
    <!-- /Doughnut Chart -->
    
    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->

    <!-- gauge.js -->
    <script>
      var opts = {
          lines: 12,
          angle: 0,
          lineWidth: 0.4,
          pointer: {
              length: 0.75,
              strokeWidth: 0.042,
              color: '#1D212A'
          },
          limitMax: 'false',
          colorStart: '#1ABC9C',
          colorStop: '#1ABC9C',
          strokeColor: '#F0F3F3',
          generateGradient: true
      };
      var target = document.getElementById('foo'),
          gauge = new Gauge(target).setOptions(opts);

      gauge.maxValue = 6000;
      gauge.animationSpeed = 32;
      gauge.set(3200);
      gauge.setTextField(document.getElementById("gauge-text"));
    </script>
    <!-- /gauge.js -->
@endsection