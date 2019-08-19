@extends('layouts.app')

@section('content')
<div class="cointainer otherpage-area">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			
				<h1 class="page-title">Handout Sheet For Your Community</h1>				
			  <div class="input-group">
			    <span class="input-group-addon"><i class="fas fa-search"></i></span>
			    <input id="search" onKeyup="getLocations()" type="text" class="form-control" name="search" placeholder="Search your region...">
			  </div>
        <div class="form-group">
          <div class="loading">
            <img src="{{url('public/img/loading2.gif')}}" style="width:60px;height:60px;">
            </div>
        </div>
			  <div class="search-result">

			  </div>
        <div class="panel-default">
            <div class="panel-body post-result"></div>
        </div>
			
		</div>

	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  function getLocations(){
  		var hangout="true";
      var location= $("#search").val();


            $.ajax({

              url : "<?php echo url('visitor-search-region')?>"+'/'+location +"/"+ hangout,            
              type: "GET",
              dataType: "HTML",
              success: function(data)
              {
                 console.log(data); 
               	$(".search-result").html(data);
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  //alert('Error deleting data');
              }
          });
  }

  function hangout(id, region){
      
        $.ajax({

              url : "<?php echo url('post-hangout')?>"+'/'+region,            
              type: "GET",
              dataType: "HTML",
              beforeSend:function(){
                $(".hangout-region").hide();
                  $(".loading").show();
              },
              success: function(data)
              {
                $(".loading").hide();
                 console.log(data); 
                $(".post-result").html(data);
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  //alert('Error deleting data');
              }
          });      
  }
</script>
@endsection