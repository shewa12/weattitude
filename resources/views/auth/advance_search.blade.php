@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row" style="margin-top:50px;">
			<h1 class="page-title">Advance Search Result</h1>
            <div class='table-responsive'>
                <table class='table table-border'>
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Regions</th>
                            <th>Issues</th>
                            <th>Severities</th>
                            <th>Initiatives</th>
                            <th>Recommendations</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                    <?php $i= 1;?>
                    @forelse($data as $value)	
		                <tr>
		                    <td>{{$i++}}</td>
		                    <td>{{$value->location_name}}</td>
		                    <td>{{$value->content}}</td>
		                    <td>{{$value->severity}}</td>
		                    <td>{{$value->initiatives}}</td>
		                    <td>{{$value->recommendation}}</td>
		                </tr>
		            @empty
		            <tr>
		            	<td>No record found</td>
		            </tr>    
		            @endforelse
                    </tbody>
                </table>
                <a class="btn-default btn" href="{{route('issueSuggestedSolution')}}">Back</a>
            </div>            
	</div>
</div>
@endsection