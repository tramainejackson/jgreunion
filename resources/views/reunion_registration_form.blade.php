<div id="reunionRegistrationForm">
	<h1>Jackson-Green {{ $reunion->reunion_year }} Registration Form</h1>
	<!--- <h3 id="registrationDueAlert">All Registration Fees Are Due No Later Than June 1<sup>st</sup>, 2016</h3> --->
	<form name="registrationForm" id="registrationForm">
		<div id="registration_form_content">
			<label for="name">Name:</label><input type="text" name="name" id="name" class="label_input" placeholder="First and Last Name" required/>
			<label for="address">Address:</label><input type="text" name="address" id="address" class="label_input" placeholder="Home Address" required/>
			<label for="phone">Phone:</label><input type="text" name="phone" id="phone" class="label_input" placeholder="###-###-####" required/>
			<label for="email">Email:</label><input type="email" name="email" id="email" class="label_input" placeholder="Email Address" required/>
		</div>
		<table id="registrationFormTable">
			<tr>
				<th></th>
				<th>Cost Per Person</th>
				<th>Number Attending</th>
				<th>Total Cost</th>
			</tr>
				
			<tr id="adult_row">
				<td>Adults (Ages 16+)</td>
				<td class="costPP">$100.00</td>
				<td><input type="number" name="attending_adult" id="attending_adult" class="table_input" min="0" value="0"/></td>
				<td><input type="number" name="total_adult" id="total_adult" class="table_input" disabled/></td>
			</tr>
			
			<tr id='attending_youth_row_default' class='attending_adult_row'>
				<td></td>
				<td></td>
				<td><input type='text' name='attending_adult_name[]' class='attending_adult_name' placeholder='Adult Name' value='No Adult' /></td>
				<td>
					<select name='shirt_size[]' class='shirt_size'>
						<option value='' name='shirt_size_option' selected></option>
						<option value='small' name='shirt_size_option'>Small</option>
						<option value='medium' name='shirt_size_option'>Medium</option>
						<option value='large' name='shirt_size_option'>Large</option>
						<option value='xl' name='shirt_size_option'>XL</option>
						<option value='xxl' name='shirt_size_option'>XXL</option>
						<option value='3xl' name='shirt_size_option'>3XL</option>
						<option value='4xl' name='shirt_size_option'>4XL</option>
					</select>
				</td>
			</tr>
			
			<tr id="youth_row">
				<td>Youth (Ages 7-15)</td>
				<td class="costPP">$75.00</td>
				<td><input type="number" name="attending_youth" id="attending_youth" class="table_input" min="0" value="0"/></td>
				<td><input type="number" name="total_youth" id="total_youth" class="table_input" disabled/></td>
			</tr>
			
			<tr id='attending_youth_row_default' class='attending_youth_row'>
				<td></td>
				<td></td>
				<td><input type='text' name='attending_youth_name[]' class='attending_youth_name' placeholder='Youth Name' value='No Youth' /></td>
			</tr>
			
			<tr id="children_row">
				<td>Childeren (Ages 1-6)</td>
				<td class="costPP">$20.00</td>
				<td><input type="number" name="attending_children" id="attending_children" class="table_input" min="0" value="0"/></td>
				<td><input type="number" name="total_children" id="total_children" class="table_input" disabled/></td>
			</tr>
			
			<tr id='attending_children_row_default' class='attending_children_row'>
				<td></td>
				<td></td>
				<td><input type='text' name='attending_children_name[]' class='attending_children_name' placeholder='Child Name' value='No Children' /></td>
			</tr>
			
			<tr id="totalDue_row">
				<td class="total_due">Total Due:</td>
				<td class="total_due"></td>
				<td class="total_due"></td>
				<td class="total_due"><input type="number" name="total_amount_due" id="total_amount_due" class="table_input" disabled/></td>
			</tr>
			<tr id="addtionalOptionsBtn_row">
				<td colspan="4"><button id="addtionalOptionsBtn">Click here for additional options</button></td>
			</tr>
		</table>
		<table id="addtionalOptionsTable">
			<tr class="addtionalOptionsRow">
				<td class="addtionalOptionsTD1"></td>
				<td class="addtionalOptionsTD2"></td>
				<td class="addtionalOptionsTD3">
					<table id="addt_table_headers">
						<tr>
							<th>S</th>
							<th>M</th>
							<th>L</th>
							<th>XL</th>
							<th>XXL</th>
							<th>3XL</th>
							<th>4XL</th>
							<th>K-S</th>
							<th>K-M</th>
							<th>K-L</th>
						</tr>
					</table>
				</td>
			</tr>
			<tr class="addtionalOptionsRow">
				<td class="addtionalOptionsTD1">Additional Tee Shirt ($15)</td>
				<td class="addtionalOptionsTD2">
					<select id="additionalTeeOption" name="addtTee" />
						<option value="N" selected>No</option>
						<option value="Y">Yes</option>
					</select>
				</td>
				<td class="addtionalOptionsTD3">
					<table id="addt_tee_table">
						<tr>
							<td><input type="number" name="addtSmall" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="addtMedium" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="addtLarge" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="addtXL" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="addtXXL" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="addt3XL" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="addt4XL" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="addtKSmall" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="addtKMedium" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="addtKLarge" placeholder="#" min="0" disabled /></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr class="addtionalOptionsRow">
				<td class="addtionalOptionsTD1 tooltipImage" style="color:blue"><u>Fancy Cut ($5)</u><span id="fancy_cut_image"><img src="/jgreunion/public/images/fancy_cut.jpeg" /></span></td>
				<td class="addtionalOptionsTD2">
					<select type="number" id="fancyCutOption" name="fancyCut" />
						<option value="N" selected>No</option>
						<option value="Y">Yes</option>
					</select>
				</td>
				<td class="addtionalOptionsTD3">
					<table id="fancy_cut_table">
						<tr>
							<td><input type="number" name="fancySmall" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="fancyMedium" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="fancyLarge" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="fancyXL" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="fancyXXL" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="fancy3XL" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="fancy4XL" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="fancyKSmall" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="fancyKMedium" placeholder="#" min="0" disabled /></td>
							<td><input type="number" name="fancyKLarge" placeholder="#" min="0" disabled /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>
</div>