<div id="reunion_registration_form">
	{!! Form::open(['action' => ['RegistrationController@store'], 'method' => 'POST', 'name' => 'registration_form']) !!}
	<form name="registrationForm" id="registrationForm">
		<div class="form-row">
			<input type="text" name="reunion_id" class="hidden" value="{{ $reunion->id }}" hidden />
		</div>
		<div class="form-row">
			<div class="form-group col-6">
				<label for="name" class="form-label">Firstname:</label>
				<input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter Firstname" />
			</div>
			<div class="form-group col-6">
				<label for="name" class="form-label">Lastname:</label>
				<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Lastname" />
			</div>
			
		</div>
		<div class="form-group">
			<label for="address" class="form-label">Address:</label>
			<input type="text" name="address" id="address" class="form-control" placeholder="Home Address" />
		</div>
		<div class="form-row">
			<div class="form-group col-4">
				<label for="city" class="form-label">City:</label>
				<input type="text" name="city" id="city" class="form-control" placeholder="Enter City" />
			</div>
			<div class="form-group col-4">
				<label for="state" class="form-label">State:</label>
				<select class="form-control custom-select" name="state">
					@foreach($states as $state)
						<option value="{{ $state->state_abb }}" {{ old('reunion_state') && old('state') == $state->state_abb ? 'selected' : '' }}>{{ $state->state_name }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-4">
				<label for="zip" class="form-label">Zip:</label>
				<input type="number" name="zip" id="zip" class="form-control" placeholder="Enter Zip Code" />
			</div>
		</div>
		<div class="form-row">
			<label for="phone" class="form-label col-12">Phone:</label>
			<div class="form-group col-4">
				<input type="number" name="phone1" id="phone" class="form-control" placeholder="###" />
			</div>
			<div class="form-group col-4">
				<input type="number" name="phone2" id="phone" class="form-control" placeholder="###" />
			</div>
			<div class="form-group col-4">
				<input type="number" name="phone3" id="phone" class="form-control" placeholder="####" />
			</div>
		</div>			
		<div class="form-group">
			<label for="email" class="form-label">Email:</label>
			<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" />
		</div>

		<div class="">
			<table class="table" id="registrationFormTable">
				<thead>
					<tr>
						<th></th>
						<th>Cost Per Person</th>
						<th>Number Attending</th>
						<th>Total Cost</th>
					</tr>
				</thead>
				<tbody>
					<tr id="adult_row" class="attending_adult_row">
						<td>Adults (Ages 16+)</td>
						<td class="costPP">$<input type="number" name="" class="costPA" value="{{ $reunion->adult_price }}" disabled step="0.01" /></td>
						<td><input type="number" name="attending_adult" id="attending_adult" class="form-control" min="0" value="0"/></td>
						<td>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon">$</span>
								</div>
								<input type="number" name="total_adult" id="total_adult" class="form-control" disabled/>
							</div>
						</td>
					</tr>
					
					<tr id="attending_adult_row_default" class="attending_adult_row">
						<td></td>
						<td></td>
						<td>
							<input type="text" name="attending_adult_name[]" class="attending_adult_name form-control" placeholder="Enter Adult Name" value="" disabled />
						</td>
						<td>
							<select name="shirt_sizes[]" class="shirt_size custom-select form-control" disabled>
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
					
					<tr id="youth_row" class="attending_youth_row">
						<td>Youth (Ages 7-15)</td>
						<td class="costPP">$<input type="number" name="" class="costPY" value="{{ $reunion->youth_price }}" disabled step="0.01" /></td>
						<td><input type="number" name="attending_youth" id="attending_youth" class="form-control" min="0" value="0"/></td>
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
							<input type="text" name="attending_youth_name[]" class="attending_youth_name form-control" placeholder="Enter Youth Name" value="" disabled />
						</td>
						<td>
							<select name="shirt_sizes[]" class="shirt_size custom-select form-control" disabled>
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
					
					<tr id="children_row">
						<td>Childeren (Ages 1-6)</td>
						<td class="costPP">$<input type="number" name="" class="costPC" value="{{ $reunion->child_price }}" disabled step="0.01" /></td>
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
							<input type="text" name="attending_children_name[]" class="attending_children_name form-control" placeholder="Enter Child Name" value="" disabled />
						</td>
						<td>
							<select name="shirt_sizes[]" class="shirt_size custom-select form-control" disabled>
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
					
					<tr id="totalDue_row">
						<td class="total_due">Total Due:</td>
						<td class="total_due"></td>
						<td class="total_due"></td>
						<td class="total_due">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon">$</span>
								</div>
								<input type="number" name="total_amount_due" id="total_amount_due" class="form-control" disabled/>
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
</div>