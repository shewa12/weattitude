@extends('layouts.app')

@section('content')
<!--slider start-->
<div class="container-fluid sliver-area">
      <div class="main">
        <ul id="cbp-bislideshow" class="cbp-bislideshow">
          <li><img src="{{url('public/img/slides/image1.jpg')}}" alt="image01"/></li>
          <li><img src="{{url('public/img/slides/image2.jpg')}}" alt="image02"/></li>
          <li><img src="{{url('public/img/slides/image3.jpg')}}" alt="image03"/></li>
          <li><img src="{{url('public/img/slides/image4.jpg')}}" alt="image04"/></li>

        </ul>

      </div>
</div>
<!--slider end-->
<div class="container">
    <div class="row wrap-middle-box">
        <div class="middlebox">
          <h1 class="title">WEattitude.org is like match-making for philanthropy.</h1>
          <h2 class="tag">It is a thriving community of people solving key issues. Anyone can participate. It is win-win. <span class="focus"><a href="{{route('whyParticipate')}}" style="color:#42bfd4">Why Participate?</a></span></h2>
        </div>

        <div class="see col-md-4 col-md-offset-4">


          <div class="form-group">
        <button class="btn-primary btn btn-block" data-target="#myModal" data-toggle="modal" id="show">See for Yourself</button>
        <a href="{{url('register')}}" class="btn-primary btn btn-block">Create Your Account or Log-in</a>
          </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><a href="{{url('register')}}" style="color:#000;">Don't you have account?</a></h4>
      </div>
      <div class="modal-body">
          <div class="panel panel-default">
              <div class="panel-heading">Select Multiple Items</div>

              <div class="panel-body" id="demo" >
                  <form class="form form-horizontal" method="post" action="{{route('dataByInterest')}}" style="padding:20px;">
                    {{csrf_field()}}
                   
                        <div class="demo">

                          <div class="form-group">
                            <label for="select-state">Select Interest/Hobby/Job</label>
                            <select id="select-state" name="interest[]" multiple class="demo-default"   placeholder="Type here...">
                              <option value="">Search Here...</option>
                                @forelse($interests as $value)
                                <option value="{{$value->interest}}">{{$value->interest}}</option>
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
                        <button type="submit" class="btn btn-primary">Show Me </button>
 

                    </div>                  
                </form> 
              </div>  
          </div>

        

      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>
@endsection

@section('js')

<script type="text/javascript">

  function getInterest(){
      
        var location= $(".search").val();
            $.ajax({

              url : "<?php echo url('search-int-public')?>"+'/'+location,            
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
</script>
<script type="text/javascript">
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});



</script>

@endsection
