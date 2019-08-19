<html>
<head>
	<title>WeAttitude.org | Handout Sheet</title>
</head>
<body>
	<h1 align="center">WEattitude.org</h1>

	<h3>Handout Sheet for Your Community</h3>
	<div class='handout' style='background:#ffffcc; border:3px solid #ffcf9d;padding:20px; width:34%;'>
		@forelse($data as $value)
			<div>{{$value}}</div><br/>
		@empty
		@endforelse
	</div>	

</body>
</html>