@extends('layouts.app')

@section('add_scripts')
	<script>

		//Add total amounts to pay for registration
		$("body").on("change", "#attending_adult, #attending_youth, #attending_children", function(e) {
			var attendingNumA = $("#attending_adult").val();
			var attendingNumY = $("#attending_youth").val();
			var attendingNumC = $("#attending_children").val();
			var totalAmountA = Number(attendingNumA * $(".adultCostSpan").val());
			var totalAmountY = Number(attendingNumY * $(".youthCostSpan").val());
			var totalAmountC = Number(attendingNumC * $(".childCostSpan").val());
			var totalDue = Number(totalAmountA + totalAmountY + totalAmountC);
			$("#total_adult").val(totalAmountA);
			$("#total_youth").val(totalAmountY);
			$("#total_children").val(totalAmountC);
			$("#total_amount_due").val(totalDue);
		});
		
	</script>
@endsection

@section('content')
	
	<div class="container-fluid">
	
		@include('admin.nav')
		
		<div class="row">
		
			<div class="col">
			
				<!-- <div class="">
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
					
						<button class="btn btn-primary form-control" type="submit">Submit Registration</button>

					</div>
					
				</div> -->
				
			</div>
			
		</div>

		@if($registered_for_reunion !== null)
			
			<div class="row py-3">
				
				<div class="col-12">
					<div id="reunion_registration_form" class="p-2 bg-light rounded">
					
						<div class="text-center">
						
							<h2 class="">{{ $reunion->reunion_year }} Registration Form</h2>
							<h3 class="mb-4">{{ $reunion->reunion_city . ', ' . $reunion->reunion_state }}</h3>
							
						</div>

						<div class="d-flex align-items-center justify-content-around my-4">
						
							<div class="col">
								<h3 class="text-center h3-responsive">Adult Prices</h3>
								
								<div class="input-group">
									<div class="input-group-prepend">
										<i class="input-group-text fa fa-dollar" aria-hidden="true"></i>
									</div>
									
									<input type="text" class="text-center form-control adultCostSpan" value="{{ $reunion->adult_price }}" disabled />
									
									<div class="input-group-append">
										<span class="input-group-text">Per Adult</span>
									</div>
								</div>
							</div>
							
							<div class="col">
								<h3 class="text-center h3-responsive">Youth Prices</h3>
								
								<div class="input-group">
									<div class="input-group-prepend">
										<i class="input-group-text fa fa-dollar" aria-hidden="true"></i>
									</div>
									
									<input type="text" class="text-center form-control youthCostSpan" value="{{ $reunion->youth_price }}" disabled />
									
									<div class="input-group-append">
										<span class="input-group-text">Per Youth</span>
									</div>
								</div>
							</div>
							
							<div class="col">
								<h3 class="text-center h3-responsive">Children Prices</h3>
								
								<div class="input-group">
									<div class="input-group-prepend">
										<i class="input-group-text fa fa-dollar" aria-hidden="true"></i>
									</div>
									
									<input type="text" class="text-center form-control childCostSpan" value="{{ $reunion->child_price }}" disabled />
									
									<div class="input-group-append">
										<span class="input-group-text">Per Child</span>
									</div>
								</div>
							</div>
							
						</div>
						
						{!! Form::open(['action' => ['FamilyMemberController@store_registration', $reunion->id, $member->id], 'method' => 'POST', 'name' => 'registration_form']) !!}
						
							<div class="d-flex align-items-center justify-content-around my-5">
						
								<div class="rounded border col">
									<h3 class="text-center h3-responsive">Total Adults</h3>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<i class="input-group-text fa fa-hashtag" aria-hidden="true"></i>
										</div>
										
										<input type="number" name="numAdults" id="attending_adult" class="form-control" value="" placeholder="of Adults" min="1" />
										
									</div>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<i class="input-group-text fa fa-dollar" aria-hidden="true"></i>
										</div>
										
										<input type="number" name="" id="total_adult" class="form-control" value="" placeholder="Adult Cost" disabled />
										
									</div>
								</div>
								
								<div class="rounded border col">
									<h3 class="text-center h3-responsive">Total Youths</h3>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<i class="input-group-text fa fa-hashtag" aria-hidden="true"></i>
										</div>
										
										<input type="number" name="numYouth" id="attending_youth" class="form-control" value="" placeholder="of Youths" min="0" />
									</div>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<i class="input-group-text fa fa-dollar" aria-hidden="true"></i>
										</div>
										
										<input type="number" name="" id="total_youth" class="form-control" value="" placeholder="Youth Cost" disabled />
									</div>
								</div>
								
								<div class="rounded border col">
									<h3 class="text-center h3-responsive">Total Children</h3>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<i class="input-group-text fa fa-hashtag" aria-hidden="true"></i>
										</div>
										
										<input type="number" name="numChildren" id="attending_children" class="form-control" value="" placeholder="of Children" min="0" />
									</div>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<i class="input-group-text fa fa-dollar" aria-hidden="true"></i>
										</div>
										
										<input type="number" name="" id="total_children" class="form-control" value="" placeholder="Children Cost" disabled />
									</div>
								</div>
								
								<div class="rounded border align-self-start col">
									<h3 class="text-center h3-responsive">Total Cost</h3>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<i class="input-group-text fa fa-dollar" aria-hidden="true"></i>
										</div>
										
										<input type="number" name="" id="total_amount_due" class="form-control" value="" placeholder="Total Cost" min="0" disabled />
										
									</div>
								</div>
								
							</div>
							
							<div class="form-group">
							
								<label for="name" class="form-label">Registree Name:</label>
								
								<input type="text" name="registree" class="form-control" value="{{ $member->full_name() }}" placeholder="Enter Registree's Name" />
								
								@if($errors->has('registree'))
									<span class="text-danger">{{ $errors->first('firstname') }}</span>
								@endif
								
							</div>
							
							<div class="form-group">
								<label for="email" class="form-label">Email:</label>
								
								<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" value="{{ $member->email }}" />
								
								@if($errors->has('email'))
									<span class="text-danger">{{ $errors->first('email') }}</span>
								@endif
							</div>
							
							<div class="form-group">
								<label for="address" class="form-label">Address:</label>
								<input type="text" name="address" id="address" class="form-control" placeholder="Home Address" value="{{ $member->address }}" />
								
								@if($errors->has('address'))
									<span class="text-danger">{{ $errors->first('address') }}</span>
								@endif
							</div>
							
							<div class="form-row">
								<div class="form-group col-12 col-sm-4">
									<label for="city" class="form-label">City:</label>
									<input type="text" name="city" id="city" class="form-control" placeholder="Enter City" value="{{ $member->city }}" />
								
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
									<input type="number" name="zip" id="zip" class="form-control" placeholder="Enter Zip Code" value="{{ $member->zip }}" />
									
									@if($errors->has('zip'))
										<span class="text-danger">{{ $errors->first('zip') }}</span>
									@endif
								</div>
							</div>
							
							<div class="form-group">
								<label for="phone" class="form-label">Phone:</label>
								
								<input type="text" name="phone" id="phone" class="form-control" placeholder="###" value="{{ $member->phone }}" />
								
								@if($errors->has('phone'))
									<span class="text-danger">{{ $errors->first('phone') }}. No special charactions required</span>
								@endif
							</div>

							<div class="">
								
								<button class="btn blue" type="submit">Update Your Registration</button>
								
							</div>
							
						{!! Form::close() !!}
						
					</div>
					
				</div>
				
			</div>
		
		@else
			
			<div class="row py-3">
				
				<div class="col-12">
					<div id="reunion_registration_form" class="p-2 bg-light rounded">
					
						<div class="text-center">
						
							<h2 class="">{{ $reunion->reunion_year }} Registration Form</h2>
							<h3 class="mb-4">{{ $reunion->reunion_city . ', ' . $reunion->reunion_state }}</h3>
							
						</div>

						<div class="d-flex align-items-center justify-content-around my-4">
						
							<div class="col">
								<h3 class="text-center h3-responsive">Adult Prices</h3>
								
								<div class="input-group">
									<div class="input-group-prepend">
										<i class="input-group-text fa fa-dollar" aria-hidden="true"></i>
									</div>
									
									<input type="text" class="text-center form-control adultCostSpan" value="{{ $reunion->adult_price }}" disabled />
									
									<div class="input-group-append">
										<span class="input-group-text">Per Adult</span>
									</div>
								</div>
							</div>
							
							<div class="col">
								<h3 class="text-center h3-responsive">Youth Prices</h3>
								
								<div class="input-group">
									<div class="input-group-prepend">
										<i class="input-group-text fa fa-dollar" aria-hidden="true"></i>
									</div>
									
									<input type="text" class="text-center form-control youthCostSpan" value="{{ $reunion->youth_price }}" disabled />
									
									<div class="input-group-append">
										<span class="input-group-text">Per Youth</span>
									</div>
								</div>
							</div>
							
							<div class="col">
								<h3 class="text-center h3-responsive">Children Prices</h3>
								
								<div class="input-group">
									<div class="input-group-prepend">
										<i class="input-group-text fa fa-dollar" aria-hidden="true"></i>
									</div>
									
									<input type="text" class="text-center form-control childCostSpan" value="{{ $reunion->child_price }}" disabled />
									
									<div class="input-group-append">
										<span class="input-group-text">Per Child</span>
									</div>
								</div>
							</div>
							
						</div>
						
						{!! Form::open(['action' => ['FamilyMemberController@store_registration', $reunion->id, $member->id], 'method' => 'POST', 'name' => 'registration_form']) !!}
						
							<div class="d-flex align-items-center justify-content-around my-5">
						
								<div class="rounded border col">
									<h3 class="text-center h3-responsive">Total Adults</h3>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<i class="input-group-text fa fa-hashtag" aria-hidden="true"></i>
										</div>
										
										<input type="number" name="numAdults" id="attending_adult" class="form-control" value="" placeholder="of Adults" min="1" />
										
									</div>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<i class="input-group-text fa fa-dollar" aria-hidden="true"></i>
										</div>
										
										<input type="number" name="" id="total_adult" class="form-control" value="" placeholder="Adult Cost" disabled />
										
									</div>
								</div>
								
								<div class="rounded border col">
									<h3 class="text-center h3-responsive">Total Youths</h3>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<i class="input-group-text fa fa-hashtag" aria-hidden="true"></i>
										</div>
										
										<input type="number" name="numYouth" id="attending_youth" class="form-control" value="" placeholder="of Youths" min="0" />
									</div>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<i class="input-group-text fa fa-dollar" aria-hidden="true"></i>
										</div>
										
										<input type="number" name="" id="total_youth" class="form-control" value="" placeholder="Youth Cost" disabled />
									</div>
								</div>
								
								<div class="rounded border col">
									<h3 class="text-center h3-responsive">Total Children</h3>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<i class="input-group-text fa fa-hashtag" aria-hidden="true"></i>
										</div>
										
										<input type="number" name="numChildren" id="attending_children" class="form-control" value="" placeholder="of Children" min="0" />
									</div>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<i class="input-group-text fa fa-dollar" aria-hidden="true"></i>
										</div>
										
										<input type="number" name="" id="total_children" class="form-control" value="" placeholder="Children Cost" disabled />
									</div>
								</div>
								
								<div class="rounded border align-self-start col">
									<h3 class="text-center h3-responsive">Total Cost</h3>
									
									<div class="input-group">
										<div class="input-group-prepend">
											<i class="input-group-text fa fa-dollar" aria-hidden="true"></i>
										</div>
										
										<input type="number" name="" id="total_amount_due" class="form-control" value="" placeholder="Total Cost" min="0" disabled />
										
									</div>
								</div>
								
							</div>
							
							<div class="form-group">
							
								<label for="name" class="form-label">Registree Name:</label>
								
								<input type="text" name="registree" class="form-control" value="{{ $member->full_name() }}" placeholder="Enter Registree's Name" />
								
								@if($errors->has('registree'))
									<span class="text-danger">{{ $errors->first('firstname') }}</span>
								@endif
								
							</div>
							
							<div class="form-group">
								<label for="email" class="form-label">Email:</label>
								
								<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" value="{{ $member->email }}" />
								
								@if($errors->has('email'))
									<span class="text-danger">{{ $errors->first('email') }}</span>
								@endif
							</div>
							
							<div class="form-group">
								<label for="address" class="form-label">Address:</label>
								<input type="text" name="address" id="address" class="form-control" placeholder="Home Address" value="{{ $member->address }}" />
								
								@if($errors->has('address'))
									<span class="text-danger">{{ $errors->first('address') }}</span>
								@endif
							</div>
							
							<div class="form-row">
								<div class="form-group col-12 col-sm-4">
									<label for="city" class="form-label">City:</label>
									<input type="text" name="city" id="city" class="form-control" placeholder="Enter City" value="{{ $member->city }}" />
								
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
									<input type="number" name="zip" id="zip" class="form-control" placeholder="Enter Zip Code" value="{{ $member->zip }}" />
									
									@if($errors->has('zip'))
										<span class="text-danger">{{ $errors->first('zip') }}</span>
									@endif
								</div>
							</div>
							
							<div class="form-group">
								<label for="phone" class="form-label">Phone:</label>
								
								<input type="text" name="phone" id="phone" class="form-control" placeholder="###" value="{{ $member->phone }}" />
								
								@if($errors->has('phone'))
									<span class="text-danger">{{ $errors->first('phone') }}. No special charactions required</span>
								@endif
							</div>

							<div class="">
								
								<button class="btn green" type="submit">Sign Up For This Reunion</button>
								
							</div>
							
						{!! Form::close() !!}
						
					</div>
					
				</div>
				
			</div>
		
		@endif
		
		<div id="" class="d-flex flex-wrap align-items-stretch justify-content-center">
			
			<!-- Hotel information -->
			<div class="col-6 my-1" id="">
			
				<div class="card h-100">
					
					@if($reunion->hotel)
						
						<div class="">
							<h2 id="" class="text-center text-light">Hotel Information</h2>
						</div>
						
						<div class="">
							<img src="{{ asset($reunion->hotel->picture != null ? $reunion->hotel->picture : '/images/hotel_default.jpg' ) }}" class="mw-100" />
						</div>
						
						<div class="">
							<p class="my-1"><span class="hotelInfoLabel">Hotel:</span> {{ $reunion->hotel->name != null ? $reunion->hotel->name : 'Not Hotel Added Yet' }}</p>
							
							<p class="my-1"><span class="hotelInfoLabel">Location:</span> {{ $reunion->hotel->location != null ? $reunion->hotel->location : 'Not Hotel Location Added Yet' }}</p>
							
							<p class="my-1"><span class="hotelInfoLabel">Room:</span> {{ $reunion->hotel->cost != null ? '$' . $reunion->hotel->cost . '/per night (not including taxes and fees)' : 'Not Hotel Room Cost Added Yet' }}</p>
							
							<p class="my-1"><span class="hotelInfoLabel">Contact:</span> {{ $reunion->hotel->phone != null ? $reunion->hotel->phone : 'Not Hotel Contact Added Yet'  }}</p>
							
							@if($reunion->hotel->phone != null)
								<p class="my-1"><span class="hotelInfoLabel">Additional Info:</span> Please call for any room upgrades.</p>
							@endif
							
							@if($reunion->hotel->book_room_link == null && $reunion->hotel->phone != null)
								<p class="my-1">*** Please Call To Book Room ***</p>
							@endif
						
						</div>
						
						<div class="">
						
							<div class="form-block-header mb-xl-3">
							
								<h3 class="text-center">Hotel Amenities</h2>							
							</div>
							
							<div class="">
							
								<ul class="list-unstyled px-1">
								
									@if($reunion->hotel->features->isNotEmpty())
										
										@foreach($reunion->hotel->features as $hotel_feature)
										
											<li class="">{{ $hotel_feature->feature_desc }}</li>
										
										@endforeach
										
									@else
										
										<li class="text-center text-muted">We're still gathering information about the hotel and its amenities. Check back later for additional information</li>
										
									@endif
									
								</ul>
								
							</div>
						</div>
						
						@if($reunion->hotel->book_room_link !== null)
							
							<div class="col-12 text-center">
								<a href="{{ $reunion->hotel->book_room_link }}" class="btn btn-warning btn-lg" target="_blank">Book Hotel Room</a>
							</div>
							
						@endif
					
					@else
						
						<div class="col-12">
							<h2 class="text-center">No Hotel Added Yet For This Reunion</h2>
						</div>
						
					@endif
					
				</div>
			</div>
			
			<!-- Activities information -->
			<div class="col-6 my-1" id="">
			
				<div class="card h-100">
					
					<div class="">
						<h2 id="" class="text-center text-light">Activities</h2>
					</div>
					
					@if($reunion->events->count() < 1)
						
						<div class="">
							<p class="text-center mt-3 emptyInfo">No Activities Added Yet</p>
						</div>
						
					@else
						
						<div class="activities_content">
						
							@foreach($reunion->events as $events)
							
								<div class="activitiesEvent container-fluid">
									<div class="row">
										@foreach($events as $event)
											@php
												$eventDate = new Carbon\Carbon($event->event_date);
											@endphp
											@if($loop->first)
												<div class="col-12 my-3">
													<h2 class="activitiesEventLocation d-inline">{{ $eventDate->format('m/d/Y') }}</h2>
												</div>
											@endif
													
											@if($loop->first)
												<div class="col-12">
													<ul class="activitiesDescription col-12">
											@endif
												<li class=""><b><em>Location:&nbsp;</em></b>{{ $event->event_location }}</li>
												<li class=""><b><em>Event Description:&nbsp;</em></b>{{ $event->event_description }}</li>
												@if(!$loop->last)<li class="spacer-sm"></li>@endif
											@if($loop->last)
													</ul>
												</div>
											@endif
											
										@endforeach
										
									</div>
									
								</div>
								
							@endforeach
							
						</div>
						
					@endif
					
				</div>
				
			</div>
			
			<!-- Contact/Committee information -->
			<div class="col-6 my-1" id="">
			
				<div class="card h-100">
					
					<div class="">
						<h2 id="" class="text-center text-light">Committee Information</h2>
					</div>
					
					<div class="table-responsive">
					
						<table id="" class="table table-hover">
							<thead>
								<tr>
									<th><u>Title</u></th>
									<th><u>Name</u></th>
									<th><u>Email Address</u></th>
								</tr>
							</thead>
							
							<tbody>
								@foreach($reunion->committee as $committee)
									<tr>
										<td>{{ ucwords(str_ireplace('_', ' ', $committee->member_title)) }}</td>
										<td>{{ ucwords($committee->member_name) }}</td>
										<td><i>{{ $committee->member_email }}</i></td>
									</tr>
								@endforeach
								
								<tr>
									<td>Web Designer</td>
									<td>Tramaine Jackson</td>
									<td><i>jackson.tramaine3@yahoo.com</i></td>
								</tr>
							</tbody>
						</table>
						
					</div>
					
				</div>
			</div>
			
			<!-- Payment Information -->
			<div class="col-6 my-1" id="">
				
				<div class="card h-100">
					
					<div class="">
						<h2 class="text-center text-light">Payment Information</h2>
					</div>
					
					<div id="paper_payment_option" class="payment_option">
					
						@php $committee_president = $reunion->committee()->president(); @endphp
						
						@if($committee_president->count() > 0)
							<h2>Paper Payment</h2>
							<p>Please make all checks payable to {{ $committee_president->firstname . ' ' . $committee_president->lastname }}. Checks can be sent to:</p>
						@endif
						
						@if($committee_president->count() > 0)

							@if(strlen($committee_president->family_member->full_address()) > 5)
								<p id="checks_address">
									<span>Address:</span>
									<span>{{ $committee_president->family_member->full_address()}}</span></span>
								</p>
								<p class="paymentsFinePrint">*Partial payments accepted</p>
								<p class="paymentsFinePrint">*Any return checks will incur a $30 penalty fee</p>
							@endif
							
							@if($reunion->registration_form != null)
								<p>Click 
									<a href="{{ asset('storage/' . str_ireplace('public/', '', $reunion->registration_form)) }}" download="{{ $reunion->reunion_year }}_Registration_Form">here</a> to download the registration form.
								</p>
							@else
								<p class="">Paper Registration Form Has Not Been Uploaded Yet</p>
							@endif
						@else
							<p class="text-danger" id="checks_address">Committee Members Not Completed Yet. Once Members Addedd, An Address Will Be Available</p>
						@endif
					</div>
					
					<div id="electronic_payment_option" class="payment_option">
						<h2>Electronic Payment</h2>
						<p>All electronic payments can be sent to administrator@jgreunion.com for anyone who already has a paypal account.</p>
						<p>Click <a href=" https://www.paypal.com/pools/c/85OCIIUoUB" target="_blank">here</a> to go to paypal.</p>
					</div>
					
					@if(!Auth::check())
						
						<div class="" id="registrationReminderMsg">
							<p>Please do not send any payment without completing the registration form first. You can click <span id="registrationLink" class="d-none d-sm-inline" data-toggle="modal" data-target="#registration_modal">here</span><a href="/upcoming_reunion/{{$reunion->id}}/registration_form" id="registrationLink" class="d-sm-none d-inline" >here</a> to complete your registration for the upcoming reunion.</p>
						</div>
						
					@else
						
						<div class="" id="registrationReminderMsg">
							<p class="text-center">You are currently logged in as an admin. Please select <a href="/registrations/create/{{$reunion->id}}" id="registrationLink" class="d-inline" >here</a> to complete the registration for someone else.</p>
						</div>
						
					@endif
					
				</div>
			</div>
			
		</div>
	
	</div>

@endsection