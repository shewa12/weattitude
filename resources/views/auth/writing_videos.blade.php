@extends('layouts.app')

@section('content')
<div class="container otherpage-area">
<?php 
function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
    }
?>	
	<div class="col-md-10 col-md-offset-2">
		<div class="tags" style="margin-bottom:50px;margin-top:20px;">
			@forelse($tags as $value)
				<?php
				 	$tags=$value->tags;

				 	$array= explode(',', $tags);
				 	$n= count($array);
				 	if($n>0){
					for($i=0; $i<$n; $i++){
					$tag[]=trim($array[$i]);
						}
					}
				?>
			
			@empty
			@endforelse
			<?php 
				$values= array_unique($tag);
				//print_r($values);
				foreach($values as $value):
			?>
				<a class="" href="<?php echo url('uplifting-writing-videos/tag/'.$value)?>"><?= $value?></a>
			<?php endforeach;?>
		</div>
		@forelse($videoContents as $value)
		<div class="author">
			<img class='img-thumbnail' src="{{url('storage/app/avatars/')}}/{{$value->image}}">
			<span>By : <a>{{ $value->name}}</a></span>
			<span>On : <a><?php echo $date= date('d F, Y',strtotime($value->created_at))?></a> </span>
		</div>
		<div class="blog">
			<h1 class="blog-title"><a href="<?= url('/uplifting-writing-videos-detail/'.$value->id)?>">{{$value->title}}</a></h1>
			<div class="tags">
				<?php 
					$tags= $value->tags;
					$array= explode(',', $tags);
					$n= count($array);
					if($n>0):
					for($i=0; $i<$n; $i++):
						$tag= $array[$i]
				?>
				<a class="btn btn-outline-primary " href="<?php echo url('uplifting-writing-videos/tag/'.$tag)?>"><?= $array[$i]?></a>
				<?php 
					endfor;
					endif;
				?>
			</div>

			<div class="essay">
				<p>
					<?php 
					echo limit_text($value->essay, 25);
					?>
				</p>
				<div class="continue">
					<a href="<?= url('/uplifting-writing-videos-detail/'.$value->id)?>" class="btn primary continue-btn">Continue reading...</a>
				</div>
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