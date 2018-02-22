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
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

					<form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-md-4 control-label">E-Mail Address</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

								@if ($errors->has('email'))
									<span class="help-block text-danger">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Send Password Reset Link
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
