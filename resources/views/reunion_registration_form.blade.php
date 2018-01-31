<div id="reunion_registration_form">
	<form name="registrationForm" id="registrationForm">
		<div class="form-group">
			<label for="name" class="form-label">Name:</label>
			<input type="text" name="name" id="name" class="form-control" placeholder="First and Last Name" />
		</div>
		<div class="form-group">
			<label for="address" class="form-label">Address:</label>
			<input type="text" name="address" id="address" class="form-control" placeholder="Home Address" />
		</div>
		<div class="form-row">
			<label for="phone" class="form-label col-12">Phone:</label>
			<div class="form-group col-4">
				<input type="number" name="phone[]" id="phone" class="form-control" placeholder="###" />
			</div>
			<div class="form-group col-4">
				<input type="number" name="phone[]" id="phone" class="form-control" placeholder="###" />
			</div>
			<div class="form-group col-4">
				<input type="number" name="phone[]" id="phone" class="form-control" placeholder="####" />
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
					<tr id="adult_row">
						<td>Adults (Ages 16+)</td>
						<td class="costPP"><span>$</span><input type="number" name="" class="costPA" value="{{ $reunion->adult_price }}" disabled step="0.01" /></td>
						<td><input type="number" name="attending_adult" id="attending_adult" class="form-control" min="0" value="0"/></td>
						<td><input type="number" name="total_adult" id="total_adult" class="form-control" disabled/></td>
					</tr>
					
					<tr id="attending_youth_row_default" class="attending_adult_row">
						<td></td>
						<td></td>
						<td><input type="text" name="attending_adult_name[]" class="attending_adult_name" placeholder="Adult Name" value="No Adult" /></td>
						<td>
							<select name="shirt_size[]" class="shirt_size">
								<option value="" name="shirt_size_option" selected></option>
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
						<td class="costPP"><span>$</span><input type="number" name="" class="costPY" value="{{ $reunion->youth_price }}" disabled step="0.01" /></td>
						<td><input type="number" name="attending_youth" id="attending_youth" class="form-control" min="0" value="0"/></td>
						<td><input type="number" name="total_youth" id="total_youth" class="form-control" disabled/></td>
					</tr>
					
					<tr id="attending_youth_row_default" class="attending_youth_row">
						<td></td>
						<td></td>
						<td><input type="text" name="attending_youth_name[]" class="attending_youth_name" placeholder="Youth Name" value="No Youth" /></td>
					</tr>
					
					<tr id="children_row">
						<td>Childeren (Ages 1-6)</td>
						<td class="costPP"><span>$</span><input type="number" name="" class="costPC" value="{{ $reunion->child_price }}" disabled step="0.01" /></td>
						<td><input type="number" name="attending_children" id="attending_children" class="form-control" min="0" value="0"/></td>
						<td><input type="number" name="total_children" id="total_children" class="form-control" disabled/></td>
					</tr>
					
					<tr id="attending_children_row_default" class="attending_children_row">
						<td></td>
						<td></td>
						<td><input type="text" name="attending_children_name[]" class="attending_children_name" placeholder="Child Name" value="No Children" /></td>
					</tr>
					
					<tr id="totalDue_row">
						<td class="total_due">Total Due:</td>
						<td class="total_due"></td>
						<td class="total_due"></td>
						<td class="total_due"><input type="number" name="total_amount_due" id="total_amount_due" class="form-control" disabled/></td>
					</tr>
					<tr id="">
						<td class="">
							<input type="submit" name="total_amount_due" id="total_amount_due" class="btn btn-primary form-control" value="Submit Registration" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</form>
</div>