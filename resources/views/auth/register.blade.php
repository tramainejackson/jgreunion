@extends('layouts.app')

@section('styles')
	@include('function.bootstrap_css')
@endsection

@section('scripts')
	@include('function.bootstrap_js')
@endsection

@section('content')
	<div class="container" id="registerPage">
		<div id="navi" class="loginPageNavi">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<nav class="nav nav-pills justify-content-end">
							<a href="/" class="homeLink nav-link">Home</a>
							
							@if(!Auth::check())
								<!-- <a href='/register' class='profileLink nav-link active'>Register</a> -->
								<a href='/login' class='profileLink nav-link'>Login</a>
							@else
								<!-- <a href='/profile' class='profileLink nav-link'>My Profile</a> -->
								<a href='/logout' class='profileLink nav-link'>Logout</a>
							@endif
						</nav>
					</div>
				</div>
			</div>			
			<div id="family_account" class="mt-5">
				<div class="page_header">
					<h1 class="text-center display-3 my-5">Jackson &amp; Green Family Reunion</h1>
				</div>
			</div>
		</div>
		<div id="registration_div_wrapper">
			<div id="registration_div">
				<h2 id="reg_form_header">Register</h2>
				<div id="reg_form_input">
					{!! Form::open(['action' => 'RegistrationController@store', 'method' => 'POST']) !!}
						<div class="form-group">
							{{ Form::label('first_name', 'Firstname', ['class' => 'regInput regFNInput nameInput form-control-label']) }}
							{{ Form::text('first_name', '', ['class' => 'form-control', 'placeholder' => 'Enter Firstname', 'value' => old('first_name')]) }}
							
							@if ($errors->has('first_name'))
								<span class="text-danger">Firstname cannot be empty</span>
							@endif
						</div>
						<div class="form-group">
							{{ Form::label('last_name', 'Lastname', ['class' => 'regInput regFNInput nameInput form-control-label']) }}
							{{ Form::text('last_name', '', ['class' => 'form-control', 'placeholder' => 'Enter Lastname', 'value' => old('last_name')]) }}
							
							@if ($errors->has('last_name'))
								<span class="text-danger">Lastname cannot be empty</span>
							@endif
						</div>
						<div class="form-group">
							{{ Form::label('email', 'Email Address', ['class' => 'regInput regFNInput nameInput form-control-label']) }}
							{{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Enter Email Address', 'value' => old('email')]) }}
							
							@if ($errors->has('email'))
								<span class="text-danger">Email Address cannot be empty</span>
							@endif
						</div>
						<div class="form-group">
							{{ Form::label('username', 'Username', ['class' => 'regInput regFNInput nameInput form-control-label']) }}
							{{ Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Enter Username', 'value' => old('username')]) }}
							
							@if ($errors->has('username'))
								<span class="text-danger">Username cannot be empty</span>
							@endif
						</div>
						<div class="form-group">
							{{ Form::label('password', 'Password', ['class' => 'regInput regFNInput nameInput form-control-label']) }}
							{{ Form::text('password', '', ['class' => 'form-control', 'placeholder' => 'Enter Password', 'value' => old('password')]) }}
							
							@if ($errors->has('password'))
								<span class="text-danger">Password cannot be empty</span>
							@endif
						</div>
						<div class="form-group">
							{{ Form::submit('Register', ['id' => 'reg_form_btn', 'class' => 'form-control mt-3']) }}
						</div>
					{!! Form::close() !!}
				</div>	
			</div>
		</div>
	</div>
@endsection