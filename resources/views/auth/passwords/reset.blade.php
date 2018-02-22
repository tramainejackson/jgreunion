@extends('layouts.app')

@section('styles')
	@include('function.bootstrap_css')
@endsection

@section('scripts')
	@include('function.bootstrap_js')
@endsection

@section('content')
	<div class="container" id="loginPage">
		<div id="navi" class="loginPageNavi">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<nav class="nav nav-pills justify-content-end">
							<a href="/" class="homeLink nav-link">Home</a>
							
							@if(!Auth::check())
								<!-- <a href='/register' class='profileLink nav-link'>Register</a> -->
								<a href='/login' class='profileLink nav-link active'>Login</a>
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
		<div id="login_div_wrapper">
			<div id="login_div">
				<h2 id="reg_form_header">Reset Password</h2>

				<div id="login_form_input">
					<form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
						{{ csrf_field() }}

						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-md-4 control-label">E-Mail Address</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

								@if ($errors->has('email'))
									<span class="help-block text-danger">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label for="password" class="col-md-4 control-label">Password</label>

							<div class="col-md-6">
								<input id="password" type="password" class="form-control" name="password" required>

								@if ($errors->has('password'))
									<span class="help-block text-danger">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
							<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

								@if ($errors->has('password_confirmation'))
									<span class="help-block text-danger">
										<strong>{{ $errors->first('password_confirmation') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Reset Password
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
