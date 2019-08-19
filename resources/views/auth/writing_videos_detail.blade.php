@extends('layouts.app')

@section('content')
<div class="container otherpage-area">

	<div class="col-md-8 col-md-offset-2">
		@forelse($videoContents as $value)

		<h1 align="center" class="blog-title"><a href="">{{$value->title}}</a></h1>

		<div class="author" style="text-align:center;margin-bottom:40px">
			<img class='img-thumbnail' src="{{url('storage/app/avatars/')}}/{{$value->image}}">
			<span>By : <a>{{ $value->name}}</a></span>
			<span>On : <a><?php echo $date= date('d F, Y',strtotime($value->created_at))?></a> </span>
		</div>
		<?php if($value->video ==''):?>
	
		<?php else:?>
		<div class="video" style="margin-bottom:40px;">
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="{{url('storage/app/videos/')}}/{{$value->video}}" allowfullscreen></iframe>
			</div>	
		</div>
		<?php endif;?>
		<div class="blog">
			

			<div class="essay">
				<p>
					{{$value->essay}}
				</p>

			</div>
		</div>
		@empty
		<h3>No record found</h3>
		@endforelse
	</div>

</div>
@endsection

@section('js')

@endsection