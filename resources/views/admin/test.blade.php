@extends('layouts.app')

@section('content')
<div class="test">
	<h3>hello</h3>
</div>
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function() {  
	setInterval(function(){
		$("body").animate({
			backgroundColor:"#000"
		},200);
	},2000);
 });
</script>
@endsection