@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-top:50px;">
               <!-- Indicators -->

<!--carousel slider--> 
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
 
           
       <?php $slide=0;?>
        <div class="pull-left">
          <ol class="carousel-indicators" style="margin-top: 50px;background:gray;width: 100px;text-align: center;border-radius: 10px;position:relative;margin-bottom:0px;">

            @forelse($projects as $value)
            @if($slide++==0)
            <li data-target="#myCarousel" data-slide-to="{{$slide-1}}" class="active"></li>
            @else
            <li data-target="#myCarousel" data-slide-to="{{$slide-1}}"></li>
            @endif
          @empty

          @endforelse            
          </ol>   
         
            </div>
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
        <?php $i= 1;?>    
        @forelse($projects as $project)
        @if($i++==1)
            <div class="item active">
                <div class="panel-default panel">
                    <div class="panel-heading blog-title">{{$project->location_name}}</div>
                    <div class="panel-body">
                         <?php $project_id=  $project->id?>
                        <div class="project_indicators col-md-6"> 
                        @forelse($indicators as $value)
                        @if($project_id==$value->project_id)
                            <div class="alert alert-info">
                                <i class="{{$value->icon}}"></i>
                                <span class="indicator-title">
                                    {{$value->title}}
                                </span>
                                <span class="direction">
                                    <i class="{{$value->direction}}"></i>
                                </span>
                                <span class="value">
                                    {{$value->indicator_value}}
                                </span>
                            </div>                        
                        @else
                        @endif
                        @empty
                        @endforelse 
                        </div>      
                        <div class="detail">
                            <h3>Success Detail</h3>
                            {{$project->detail}}
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="item">
                <div class="panel-default panel">
                    <div class="panel-heading blog-title">{{$project->location_name}}</div>
                    <div class="panel-body">
                        <?php $project_id = $project->id?>
                        <div class="project_indicators col-md-6"> 
                        @forelse($indicators as $value)
                        @if($project_id==$value->project_id)
                            <div class="alert alert-info">
                                <i class="{{$value->icon}}"></i>
                                <span class="indicator-title">
                                    {{$value->title}}
                                </span>
                                <span class="direction">
                                    <i class="{{$value->direction}}"></i>
                                </span>
                                <span class="value">
                                    {{$value->indicator_value}}
                                </span>
                            </div>                        
                        @else
                        @endif
                        @empty
                        @endforelse 
                        </div> 
                        <div class="detail">
                            <h3>Success Detail</h3>
                            {{$project->detail}}
                        </div>
                    </div>
                </div>
            </div>
        @endif    
        @empty
        <h3>No record found</h3>
        @endforelse    

          </div>


        </div>       
<!--carousel slider end-->        
	</div>
</div>
@endsection