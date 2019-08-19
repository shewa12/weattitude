@extends('layouts/app')

@section('content')
<div class="container">
	<div class="row">

		@if(Session::has('success'))
		<div class="alert-success alert">
			<h4>{!!Session::get('success')!!}</h4>
			
		</div>
		@endif
		@if(Session::has('fail'))
		<div class="alert-danger alert">
			<h4>{!!Session::get('fail')!!}</h4>
		</div>
		@endif	
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            	<div class="panel-heading">Update Password</div>
				<div class="panel-body">
					<form class="form-horizontal form col-md-4 col-md-offset-4 col-lg-4 col-lg-offset" method="post" action="{{route('updatePassword')}}">
						{{ csrf_field() }}

						<div class="form-group">
							<label>Old Password</label>
							<input type="password" class="form-control" name="old_password">
							    @if ($errors->has('old_password'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('oldpass') }}</strong>
			                        </span>
			                    @endif
						</div>			

						<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
							<label>New Password</label>
							<input type="password" class="form-control" name="password"></input>
							    @if ($errors->has('password'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('password') }}</strong>
			                        </span>
			                    @endif
						</div>			

						<div class="form-group">
							<label>Confirm Password</label>
							<input type="password" class="form-control" name="password_confirmation"></input>
							    @if ($errors->has('password_confirmation'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('password_confirmation') }}</strong>
			                        </span>
			                    @endif		
						</div>			

						<div class="form-group">
							<button class="btn-default btn">Update Password</button>
						</div>
					</form>
				</div>

            </div>
        </div>    		
		


	</div>
</div>
@endsection