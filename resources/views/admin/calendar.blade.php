@extends('admin.master')

@section('content')
	<div class="right_col" role="main">
		  <div class="row">
        <!--flass message-->
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
        <!--end flass message-->
      </div>  
      <div class="row">
          <form class="form-inline" action="" method="">
              <div class="form-group col-md-3">
                  <label>From</label>
                  <input name="fromdate" id="fromDate" class="form-control"></input>
              </div>               

              <div class="form-group col-md-3">
                  <label>To</label>
                  <input name="enddate" id="endDate" class="form-control"></input>
              </div>               

              <div class="form-group col-md-3">
                  <button class="btn-default btn" id="bookings" type="button">Show Bookings
                    <div class="loading">
                      <i class="fa fa-spinner fa-spin"></i>Loading
                    </div>
                  </button>
              </div>              

          </form>
      </div>

      <div class="row" id="result" style='margin-top:50px;'></div>

 
	</div><!--main  col div end-->
@endsection

@section('js')

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
        $( "#fromDate" ).datepicker();
        $( "#endDate" ).datepicker();
  } );
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

      $("#bookings").click(function(){
          var fromDate= $("#fromDate").val();
          var endDate= $("#endDate").val();
          var dataString= "fromDate="+fromDate+"&endDate="+endDate+"&_token="+CSRF_TOKEN;
          //alert(dataString);
          if(fromDate>endDate || fromDate=='' || endDate==''){
            alert('Invalid Date');
          }
          else{
              $.ajax({
                  url:"<?php echo url('booking-filter')?>",
                  
                  type:"POST",
                  data:dataString,
                  dataType: "HTML",
                  beforeSend:function(){
                    $(".loading").show();
                  },
                  success: function(data)
                  {
                      $(".loading").hide();
                      $("#result").html(data);
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      alert('Something went wrong');
                  }
              });
          }
      });


    });

  </script>
@endsection