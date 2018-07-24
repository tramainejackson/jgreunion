<div id="reunion_registration_form">
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
			<input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number" value="{{ old('phone') }}" />
			
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

		<div class="table-responsive">
			<table class="table" id="registrationFormTable">
				<thead>
					<tr>
						<th scope="col"></th>
						<th scope="col" abbr="Cost PP">Cost Per Person</th>
						<th scope="col">Number Attending</th>
						<th scope="col">Total Cost</th>
					</tr>
				</thead>
				<tbody>
					<tr id="adult_row">
						<td>Adults (Ages 16+)</td>
						<td class="costPP">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon">$</span>
								</div>
								
								<input type="number" name="" class="costPA form-control" value="{{ $reunion->adult_price }}" disabled />
							</div>
						</td>
						<td>
							<input type="number" name="attending_adult" id="attending_adult" class="form-control" min="1" value="0"/>
						</td>
						<td>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon">$</span>
								</div>
								<input type="number" name="total_adult" id="total_adult" class="form-control" value="{{ $reunion->adult_price }}" disabled/>
							</div>
						</td>
					</tr>
					
					<tr id="attending_adult_row_default" class="attending_adult_row">
						<td></td>
						<td></td>
						<td>
							<input type="text" name="attending_adult_name[]" class="attending_adult_name form-control" placeholder="Enter First Name" value="" disabled />
						</td>
						<td>
							<select name="adult_shirts[]" class="shirt_size browser-default form-control" disabled>
								<option value="blank" selected>----- Select A Shirt Size -----</option>
								<option value="S">Small</option>
								<option value="M">Medium</option>
								<option value="L" >Large</option>
								<option value="XL">XL</option>
								<option value="XXL">XXL</option>
								<option value="XXXL">3XL</option>
							</select>
						</td>
					</tr>
					
					<tr id="youth_row">
						<td>Youth (Ages 7-15)</td>
						<td class="costPP">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon">$</span>
								</div>
								
								<input type="number" name="" class="costPY form-control" value="{{ $reunion->youth_price }}" disabled step="0.01" />
							</div>
						</td>
						<td>
							<input type="number" name="attending_youth" id="attending_youth" class="form-control" min="0" value="0"/>
						</td>
						<td>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon">$</span>
								</div>
								<input type="number" name="total_youth" id="total_youth" class="form-control" disabled/>
							</div>
						</td>
					</tr>
					
					<tr id="attending_youth_row_default" class="attending_youth_row">
						<td></td>
						<td></td>
						<td>
							<input type="text" name="attending_youth_name[]" class="attending_youth_name form-control" placeholder="Enter First Name" value="" disabled />
						</td>
						<td>
							<select name="youth_shirts[]" class="shirt_size browser-default form-control" disabled>
								<option value="blank" selected>----- Select A Shirt Size -----</option>
								<option value="S">Youth XSmall</option>
								<option value="M">Youth Small</option>
								<option value="L" >Youth Medium</option>
								<option value="XL">Youth Large</option>
								<option value="XXL">Adult Small</option>
								<option value="XXXL">Adult Medium</option>
							</select>
						</td>
					</tr>
					
					<tr id="children_row">
						<td>Childeren (Ages 1-6)</td>
						<td class="costPP">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon">$</span>
								</div>
								
								<input type="number" name="" class="costPC form-control" value="{{ $reunion->child_price }}" disabled step="0.01" /></td>
							</div>
						<td><input type="number" name="attending_children" id="attending_children" class="form-control" min="0" value="0"/></td>
						<td>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon">$</span>
								</div>
								<input type="number" name="total_children" id="total_children" class="form-control" disabled/>
							</div>
						</td>
					</tr>
					
					<tr id="attending_children_row_default" class="attending_children_row">
						<td></td>
						<td></td>
						<td>
							<input type="text" name="attending_children_name[]" class="attending_children_name form-control" placeholder="Enter First Name" value="" disabled />
						</td>
						<td>
							<select name="children_shirts[]" class="shirt_size browser-default form-control" disabled>
								<option value="blank" selected>----- Select A Shirt Size -----</option>
								<option value="S">12 Months</option>
								<option value="M">2T</option>
								<option value="L" >3T</option>
								<option value="XL">4T</option>
								<option value="XXL">5T</option>
								<option value="XXXL">6</option>
							</select>
						</td>
					</tr>
					
					<tr id="totalDue_row">
						<td class="total_due">Total Due:</td>
						<td class="total_due"></td>
						<td class="total_due"></td>
						<td class="total_due">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon">$</span>
								</div>
								
								<input type="number" name="total_amount_due" id="total_amount_due" class="form-control" value="{{ $reunion->adult_price }}" disabled/>
							</div>
						</td>
					</tr>
					<tr class="">
						<td class="border-0">
							{{ Form::submit('Submit Registration', ['class' => 'btn btn-primary form-control', 'id' => 'total_amount_due']) }}
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	{!! Form::close() !!}
	
	@section('add_scripts')
		<script>
			$('body').on('change', '#firstname', function(e) {
				console.log($(this).val());
				$('.attending_adult_name').first().val($(this).val());
			});
		</script>

		<script>
			//Add total amounts to pay for registration
			$("body").on("change", "#attending_adult, #attending_youth, #attending_children", function(e) {
				var attendingNumA = $("#attending_adult").val();
				var attendingNumY = $("#attending_youth").val();
				var attendingNumC = $("#attending_children").val();
				var totalAmountA = Number(attendingNumA * $(".costPA").val());
				var totalAmountY = Number(attendingNumY * $(".costPY").val());
				var totalAmountC = Number(attendingNumC * $(".costPC").val());
				var totalDue = Number(totalAmountA + totalAmountY + totalAmountC);
				$("#total_adult").val(totalAmountA);
				$("#total_youth").val(totalAmountY);
				$("#total_children").val(totalAmountC);
				$("#total_amount_due").val(totalDue);
				
				console.log(totalAmountA);
				console.log(totalAmountY);
				console.log(totalAmountC);
			});
		</script>
		
	@endsection
	
	@if($errors->count() > 0)
		
		@section('add_scripts')
			<script>$('#registration_modal').modal('show');</script>
		@endsection
		
	@endif
</div>