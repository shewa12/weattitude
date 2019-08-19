@extends('admin.master')

@section('content')
	<div class="right_col" role="main">
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
            <div id="map"></div>
        </div>
        <!--gmap end-->
    </div>

	</div><!--main  col div end-->
@endsection

@section('js')

<script>
      function initMap() {

       
        var uluru = new google.maps.LatLng("-25.344", "131.036");
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: uluru
        });
        //set marker on map
        var marker = new google.maps.Marker({
          position: uluru,
          animation: google.maps.Animation.DROP,
          map: map
        });

    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?v=3.9exp&key=AIzaSyDgB7vF_nyTAIBpEyHUjtE0bzNXoTNrqcc&callback=initMap"></script>
   
@endsection