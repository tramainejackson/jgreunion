@extends('layouts.app')

@section('add_styles')

	<style>
		#reunion_page {
			background: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('{{ asset($reunion->picture) }}');
		}
		
		@media only screen and (max-width:576px) {
			#reunion_page {
				background: none;
			}
			
			#reunion_page::after {
				content: "";
				position: fixed;
				background: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('{{ asset($reunion->picture) }}');
				background-size: cover;
				background-attachment: fixed;
				background-position: center center;
				background-repeat: no-repeat;
				top: 0;
				left: 0;
				bottom: 0;
				right: 0;
				z-index: -10;
			}
			
			.costPA {
			    background: linear-gradient(orange, hsla(39, 100%, 46%, 0.6), rgba(255, 165, 0, 0.25));
				color: darkgreen;
				text-shadow: 1px 1px 0px #909090;
			}
			
			.costPY {
			    background: linear-gradient(darkorange, rgba(193, 125, 42, 0.6), rgba(255, 140, 0, 0.25));
				color: darkolivegreen;
				text-shadow: 1px 1px 0px #909090;
			}
			
			.costPC {
			    background: linear-gradient(#ff4700, rgba(255, 71, 0, 0.6), rgba(255, 71, 0, 0.25));
				color: floralwhite;
				text-shadow: 1px 1px 0px #909090;
			}
			
			.loadingSpinner p {
				font-size: 200%;
				text-align: -webkit-center;
				text-align: center;
			}
		}
	</style>
@endsection

@section('add_scripts')
	<script>
		//Add total amounts to pay for registration
		$("body").on("change", "#attending_adult, #attending_youth, #attending_children", function(e) {
			var attendingNumA = $("#attending_adult").val();
			var attendingNumY = $("#attending_youth").val();
			var attendingNumC = $("#attending_children").val();
			var totalAmountA = Number(attendingNumA * $(".adultCostSpan").text());
			var totalAmountY = Number(attendingNumY * $(".youthCostSpan").text());
			var totalAmountC = Number(attendingNumC * $(".childCostSpan").text());
			var totalDue = Number(totalAmountA + totalAmountY + totalAmountC);
			$("#total_adult").val(totalAmountA);
			$("#total_youth").val(totalAmountY);
			$("#total_children").val(totalAmountC);
			$("#total_amount_due").val(totalDue);
		});
		
		// Add registree name to the first name field
		$('body').on('change', '#firstname', function(e) {
			$('.attending_adult_row').first().find('.attending_adult_name ').val($(this).val());
		});
	</script>
@endsection

@section('content')
	<div id="reunion_page" class="pb-4">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="row">
						<button type="button" class="btn m-3 btn-dark" data-toggle="collapse" data-target="#upcoming_reunion_mobile" aria-expanded="false" aria-controls="upcoming_reunion_mobile">Menu</button>
					</div>
					<div class="row collapse" id="upcoming_reunion_mobile">
						<div class="col">
							<nav class="">
								<a href="/" class="btn btn-info btn-lg d-block my-2">Home</a>
								
								<a href="/upcoming_reunion/{{$reunion->id}}/registration_form" id="registrationFormLink" class="btn btn-info btn-lg d-block">Registration Form</a>

								<a class="btn btn-lg my-2 d-block" id="fb_link" href="https://www.facebook.com/groups/129978977047141/" target="_blank">Jackson/Green Facebook Page Click Here</a>
							</nav>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
			
				<div class="col-12">
					<h1 class="text-center py-5 text-light display-sm-3 display-4">Jackson/Green Family Reunion {{ $reunion->reunion_year }}</h1>
				</div>
				
				<div class="col-12">
					<div id="reunion_registration_form" class="p-2 bg-light rounded">
						<div class="">
							<h2 class="">{{ $reunion->reunion_year }} Registration Form</h2>
						</div>
						
						{!! Form::open(['action' => ['RegistrationController@store'], 'method' => 'POST', 'name' => 'registration_form', 'onsubmit' => 'return emptyInputCheck();']) !!}
						
						<form name="registrationForm" id="registrationForm">
							<div class="form-row">
								<input type="text" name="reunion_id" class="hidden" value="{{ $reunion->id }}" hidden />
							</div>
							<div class="form-row">
								<div class="form-group col-12 col-sm-6">
									<label for="name" class="form-label">Firstname:</label>
									<input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname') }}" placeholder="Enter Firstname" />
									
									@if($errors->has('firstname'))
										<span class="text-danger">{{ $errors->first('firstname') }}</span>
									@endif
								</div>
								<div class="form-group col-12 col-sm-6">
									<label for="name" class="form-label">Lastname:</label>
									<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Lastname" value="{{ old('lastname') }}" />
									
									@if($errors->has('lastname'))
										<span class="text-danger">{{ $errors->first('lastname') }}</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label for="address" class="form-label">Address:</label>
								<input type="text" name="address" id="address" class="form-control" placeholder="Home Address" value="{{ old('address') }}" />
								
								@if($errors->has('address'))
									<span class="text-danger">{{ $errors->first('address') }}</span>
								@endif
							</div>
							<div class="form-row">
								<div class="form-group col-12 col-sm-4">
									<label for="city" class="form-label">City:</label>
									<input type="text" name="city" id="city" class="form-control" placeholder="Enter City" value="{{ old('city') }}" />
								
									@if($errors->has('city'))
										<span class="text-danger">{{ $errors->first('city') }}</span>
									@endif
								</div>
								
								<div class="form-group col-6 col-sm-4">
									<label for="state" class="form-label">State:</label>
									
									<select class="form-control browser-default" name="state">
										@foreach($states as $state)
											<option value="{{ $state->state_abb }}" {{ old('reunion_state') && old('state') == $state->state_abb ? 'selected' : '' }}>{{ $state->state_name }}</option>
										@endforeach
									</select>
								</div>
								
								<div class="form-group col-6 col-sm-4">
									<label for="zip" class="form-label">Zip:</label>
									<input type="number" name="zip" id="zip" class="form-control" placeholder="Enter Zip Code" value="{{ old('zip') }}" />
									
									@if($errors->has('zip'))
										<span class="text-danger">{{ $errors->first('zip') }}</span>
									@endif
								</div>
							</div>
							
							<div class="form-group">
								<label for="phone" class="form-label">Phone:</label>
								<input type="text" name="phone" id="phone" class="form-control" placeholder="###" value="{{ old('phone') }}" />
								
								@if($errors->has('phone'))
									<span class="text-danger">{{ $errors->first('phone') }}. No special charactions required</span>
								@endif
							</div>
							
							<div class="form-group">
								<label for="email" class="form-label">Email:</label>
								<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" />
								
								@if($errors->has('email'))
									<span class="text-danger">{{ $errors->first('email') }}</span>
								@endif
							</div>

							<div class="">
								<ul class="list-unstyled d-flex flex-row justify-content-around align-items-stretch">
									<li class="p-1 m-1 costPA"><span class="d-block text-center">Cost Per Adult</span><span class="d-block text-center">$<span class="adultCostSpan">{{ $reunion->adult_price }}</span></span></li>
									<li class="p-1 m-1 costPY"><span class="d-block text-center">Cost Per Youth</span><span class="d-block text-center">$<span class="youthCostSpan">{{ $reunion->youth_price }}</span></span></li>
									<li class="p-1 m-1 costPC"><span class="d-block text-center">Cost Per Child</span><span class="d-block text-center">$<span class="childCostSpan">{{ $reunion->child_price }}</span></span></li>
								</ul>
								
								<div id="adult_row" class="mt-3">
									<div class="d-flex align-items-center mb-1">
										<h4 class="w-75 m-0">Adults (Ages 16+)</h4>
										<div class="w-25">
											<input type="number" name="attending_adult" id="attending_adult" class="form-control d-inline" min="1" value="0"/>
										</div>
									</div>
									
									<div class="my-1">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon">$</span>
											</div>
											<input type="number" name="total_adult" id="total_adult" class="form-control" disabled/>
										</div>
									</div>

									<div class="form-row attending_adult_row" id="attending_adult_row_default">
									
										<div class="form-group col-6">
											<input type="text" name="attending_adult_name[]" class="attending_adult_name form-control" placeholder="Enter First Name" value="" disabled />
										</div>
										
										<div class="form-group col-6">
											<select name="adult_shirts[]" class="shirt_size browser-default form-control" disabled>
												<option value="blank" selected>----- Select A Shirt Size -----</option>
												<option value="S">Small</option>
												<option value="M">Medium</option>
												<option value="L" >Large</option>
												<option value="XL">XL</option>
												<option value="XXL">XXL</option>
												<option value="XXXL">3XL</option>
											</select>
										</div>
									</div>
								</div>
								
								<div id="youth_row" class="mt-3">
									<div class="d-flex align-items-center mb-1">
										<h4 class="w-75 m-0">Youth (Ages 7-15)</h4>
										<div class="w-25">
											<input type="number" name="attending_youth" id="attending_youth" class="form-control" min="0" value="0"/>
										</div>
									</div>
									
									<div class="my-1">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon">$</span>
											</div>
											<input type="number" name="total_youth" id="total_youth" class="form-control" disabled/>
										</div>
									</div>

									<div class="form-row attending_youth_row" id="attending_youth_row_default">
									
										<div class="form-group col-6">
											<input type="text" name="attending_youth_name[]" class="attending_youth_name form-control" placeholder="Enter First Name" value="" disabled />
										</div>
										
										<div class="form-group col-6">
											<select name="youth_shirts[]" class="shirt_size browser-default form-control" disabled>
												<option value="blank" selected>----- Select A Shirt Size -----</option>
												<option value="S">Youth XSmall</option>
												<option value="M">Youth Small</option>
												<option value="L" >Youth Medium</option>
												<option value="XL">Youth Large</option>
												<option value="XXL">Adult Small</option>
												<option value="XXXL">Adult Medium</option>
											</select>
										</div>
									</div>
								</div>
								
								<div id="children_row" class="mt-3">
									<div class="d-flex align-items-center mb-1">
										<h4 class="w-75 m-0">Childeren (Ages 1-6)</h4>
										<div class="w-25">
											<input type="number" name="attending_children" id="attending_children" class="form-control" min="0" value="0"/>
										</div>
									</div>
									<div class="my-1">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon">$</span>
											</div>
											<input type="number" name="total_children" id="total_children" class="form-control" disabled/>
										</div>
									</div>
									
									<div class="form-row attending_children_row" id="attending_children_row_default">
									
										<div class="form-group col-6">
											<input type="text" name="attending_children_name[]" class="attending_children_name form-control" placeholder="Enter First Name" value="" disabled />
										</div>
										
										<div class="form-group col-6">
											<select name="children_shirts[]" class="shirt_size browser-default form-control" disabled>
												<option value="blank" selected>----- Select A Shirt Size -----</option>
												<option value="S">12 Months</option>
												<option value="M">2T</option>
												<option value="L" >3T</option>
												<option value="XL">4T</option>
												<option value="XXL">5T</option>
												<option value="XXXL">6</option>
											</select>
										</div>
									</div>
								</div>
								
								<div class="spacer-sm"></div>
								
								<div class="">
									<h4>Total Due:</h4>
									<div class="total_due">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon">$</span>
											</div>
											<input type="number" name="total_amount_due" id="total_amount_due" class="form-control" disabled/>
										</div>
									</div>
								</div>
								
								<div class="form-group my-2">
									{{ Form::submit('Submit Registration', ['class' => 'btn btn-primary form-control', 'id' => 'total_amount_due']) }}
								</div>
							</div>
							
						{!! Form::close() !!}
						
					</div>
					
				</div>
			</div>
		</div>
	</div>
@endsection