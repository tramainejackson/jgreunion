@extends('layouts.app')

@section('styles')
	@include('function.bootstrap_css')
@endsection

@section('scripts')
	@include('function.bootstrap_js')
@endsection

@section('content')
	<div class="container" id="loginPage">
		<div id="overlay"></div>
		<div id="modal"></div>
		<div id="navi" class="loginPageNavi">
			<div class="page_header">
				<h1>Jackson &amp; Green Family Reunion</h1>
			</div>
			<div id="family_account">
				@if(!Auth::check())
					<a href='/registration' class='profileLink'>Register</a>
					<a href='/login' class='profileLink'>Login</a>
				@else
					<a href='/profile' class='profileLink'>My Profile</a>
					<a href='/logout' class='profileLink'>Logout</a>
				@endif
			</div>
			<div id="home_link">
				<a href="/" class="homeLink">Home</a>
			</div>
		</div>
		<div id="login_div_wrapper">
			<div id="login_div">
				<h2 id="reg_form_header">Login</h2>
				<div id="login_form_input">
					<form class="form-horizontal" method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}
					
						<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
							<label for="username" class="form-label">Username</label>

							<div class="">
								<input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Enter Username" required autofocus>

								@if ($errors->has('username'))
									<span class="help-block">
										<strong>{{ $errors->first('username') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label for="password" class="form-label">Password</label>

							<div class="">
								<input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required>

								@if ($errors->has('password'))
									<span class="help-block">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<a class="btn btn-info" href="{{ route('password.request') }}">
								Forgot Your Password?
							</a>
						</div>

						<div class="form-group">
							{{ Form::submit('Login', ['id' => 'login_submit_btn', 'class' => 'form-control mt-3']) }}
						</div>
					</form>
				</div>	
			</div>
		</div>
	</div>
@endsection