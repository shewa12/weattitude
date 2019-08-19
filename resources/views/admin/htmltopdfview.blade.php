<html>
<head>
	<title></title>
    <link href="{{url('public/css/app.css')}}" rel="stylesheet">	
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong>Employee Name: {{Auth::user()->name}}</strong>
		</div>

		<div class="panel-body">
			<div class="responsive">
				<table class="table-bordered table">
					<thead>
						<tr>
							<th>date</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{date('Y-m-d')}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>