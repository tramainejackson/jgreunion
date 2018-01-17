@extends('layouts.app')

@section('styles')
	@include('function.bootstrap_css')
@endsection

@section('scripts')
	@include('function.bootstrap_js')
@endsection

@section('content')
	<div id="scroll_to_top"></div>
	<div id="overlay_PhillyPage"></div>
	<div id="registration_btn">
		<button id="registrationFormBtn">
			<span id="registrationFormSpan">Click here to complete the registration.</span>
			<span id="registeredUsersSpan">Click here to see who has registered.</span>
			<span id="newsLetterSpan">Click here to view the family news letter.</span>
		</button>
	</div>
	<div id="modals_div">
		<div id="confirmation_modal">
			<h1 id="confirmationFormHeader">Confirmation Review</h1>
			<div id="confirmationForm">
				<p class="confirmationP">First Name: </p><span class="confirm_name"></span>
				<p class="confirmationP">Address: </p><span class="confirm_address"></span>
				<p class="confirmationP">Phone Number: </p><span class="confirm_phone"></span>
				<p class="confirmationP">Email Address: </p><span class="confirm_email"></span>
				<p class="confirmationP">Total Adults: </p><span class="confirm_adults"></span>
				<p class="confirmationP">Total Youth: </p><span class="confirm_youth"></span>
				<p class="confirmationP">Total Children: </p><span class="confirm_children"></span>
				<p class="confirmationP">Total Additional Tees: </p><span class="confirm_addtTee"></span>
				<p class="confirmationP">Total Female Cut Tees: </p><span class="confirm_gcTee"></span>
				<p class="confirmationP">Total Amount Due: </p><span class="confirm_total"></span>
				<table class="confirm_attendees">
					<caption>Attendees</caption>
				</table>
				<button id="confirmFormBtn">Confirm Information</button>
				<button class="editFormBtn">Edit Information</button>
			</div>
		</div>
		<div id="confirmed_modal">
			<h2>Confirmed Registration</h2>
		</div>
		<div id="registration_modal">
			<div id="phillyRegistrationForm">
				<h1>Jackson-Green 2016 Registration Form</h1>
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
			<button class="closeBtn" id="close_registered_modal"></button>
			<button class="table_input" id="submitRegistration">Submit</button>			
		</div>
		<div id="registered_modal">
			<div id="all_registered_user">
				<table id='registered_members'>
					<caption>All Registrations</caption>
					<tr>
						<th class='registeredModalTH'><u>Name</u></th>
						<th class='registeredModalTH'><u>Registered Date</u></th>
					</tr>

					@foreach($registrations as $registration)
						<tr>
							<td class='registeredModalTD'>{{ ucwords(strtolower($registration->registree_name)) }}</td>
							<td class='registeredModalTD'>{{ $registration->reg_date }}</td>
						</tr>
					@endforeach
				</table>
			</div>
			<button class="closeBtn" id="close_registered_users"></button>
		</div>
		<div id="errors_modal">
			<h2 id="errors_modal_header">Errors</h2>
			<div id="errors_modal_content">
				<p id="errors_modal_contentP"></p>
			</div>
		</div>
	</div>
	<div id="page_header">
		<h1 id="jgphilly_page_header">Jackson/Green Family Reunion 2016</h1>
	</div>
	<div id="reunion_page" class="reunion_page_class">
		<div class="reunion_content" id="hotel_information">
			<h2 id="hotel_information_header">Hotel Information</h2>
			<div id="hotel_content">
				<img id="hotel_pic" src="/images/crowne-plaza-feasterville-trevose-2533231492-4x3.jpg"/>				
				<p class="hotelContentInfo"><b>Address:</b> 4700 Street Rd, Feasterville-Trevose, PA 19053</p>
				<p class="hotelContentInfo"><b>Phone:</b> 1-215-364-2000</p>	
				<p class="hotelContentInfo"><b>Rooms:</b> $109/per night plus taxes for a standard room</p>
				<p class="hotelContentInfo"><b>Additional Info:</b> Please call for any room upgrades.</p><br/>
				<dl>
					<dt class="featuresList hotelContentInfo"><b>Hotel Features:</b></dt>
					<dd class="featuresList hotelContentInfo">Complimentary Wifi</dd>
					<dd class="featuresList hotelContentInfo">Free Parking</dd>
					<dd class="featuresList hotelContentInfo">Microwave/Refrigerator in guest room</dd>
					<dd class="featuresList hotelContentInfo">Fitness Center</dd>
					<dd class="featuresList hotelContentInfo">Swimming Pool</dd>
					<dd class="featuresList hotelContentInfo">Sofa-Bed</dd>
					<dd class="featuresList hotelContentInfo">Rollway Bed/Cot</dd>
					<dd class="featuresList hotelContentInfo">Electronic Check</dd>
					<dd class="featuresList hotelContentInfo" id="directions_link">Click Here For Directions</dd>
				</dl>
				<a href="https://resweb.passkey.com/go/JGFR8416" target="_blank"><button>Book Room Here</button></a>
			</div>
			<div id="hotel_directions">
				<div class="directionOptions" id="directions1">
					<h2>Philadelphia and South</h2>
					<p>
						Follow I-95 North to Street Road (Route 132 West) Exit #37. Turn left onto
						Street Road and proceed five miles. The hotel will be on your left.
					</p>
				</div>
				<div class="directionOptions" id="directions2">
					<h2>From Trenton/Lawrenceville/Princeton and North</h2>
					<p>
						Follow I-95 South to Street Road (Route 132 West) Exit #37. Turn left onto
						Street Road and proceed five miles. The hotel will be on your left.
					</p>
				</div>
				<div class="directionOptions" id="directions3">
					<h2>From Pennsylvania Turnpike</h2>
					<p>
						PA Turnpike to Exit 351 and stay to right after toll to Route 1 South. Take first
						exit for Street Road West RT 132 and proceed one mile. The hotel will be a 1/2 mile
						on your left.
					</p>
				</div>
				<div class="directionOptions" id="directions4">
					<h2>From New York City and New England</h2>
					<p>
						Take I-95 South to New Jersey Turnpike South. Use Exit 6 of the NJ Turnpike for
						the Pennsylvania Turnpike. Follow the directions from the PA Turnpike.
					</p>
				</div>
				<button id="close_directions">Close</button>
			</div>
		</div>
		<hr/>
		<div class="reunion_content" id="activities_information">
			<h2 id="activities_information_header">Activities</h2>
			<div class="activities_content"><div class="activities_content_bgrd_skirt"></div>
				<h2>Thursday, August 4<sup>th</sup></h2>
				<ul>
					<li>12PM - Reunion Check In Starts</li>
					<li>6-8PM Meet and Greet (Hospitality Suite)</li>
					<li>6-8PM Line Dance Fun</li>
				</ul>
				
				<h2>Friday, August 5<sup>th</sup></h2>
				<ul>
					<li>12-6PM Neshaminy State Park Family Picnic</li>
					<li>6PM-Until Philadelphia Night Attractions (Free Time)</li>
				</ul>
				
				<h2>Saturday, August 6<sup>th</sup></h2>
				<ul>
					<li>Enjoy Philadelphia During the Day</li>
					<li>6-10PM Family Banquet</li>
					<li><i>Banquet Attire: Black and Gold</i></li>
				</ul>
				
				<h2>Sunday, August 7<sup>th</sup></h2>
				<ul>
					<li>10AM-12PM Church Service</li>
				</ul>
				
				<h2>Additional Information</h2>
				<p>
					On Friday evening and Saturday morning, you are free to partake in the many
					Philadelphia activities. We have included the activities you can choose from. Some places 
					(Philadelphia Zoo, Sesame Place and Philly Bus Tour) the committee will setup group 
					rates if enough people show interest in going.
				</p>
				<p>
					***Parx Casino, Philadelphia Zoo, Franklin Mills Mall, Sesame Place, Skyzone Trampoline
					Park, Arnold's Family Fun (bowling, go-carts), Philly Bus Tour, Movie Tavern, Downtown Philly***
				</p>
			</div>
		</div>	
		<hr/>
		<div class="reunion_content" id="contact_information">
			<h2 id="contact_information_header">Committee Information</h2>
			<div id="contact_content">
				<table id="contact_information_table">
					<tr>
						<th><u>Title</u></th>
						<th><u>Name</u></th>
						<th><u>Email Address</u></th>
					</tr>
					<tr>
						<td>President</td>
						<td>Lorenzo Jackson Sr</td>
						<td><i>mrlorenzo412@yahoo.com</i></td>
					</tr>
					<tr>
						<td>Vice President</td>
						<td>Lorenzo Jackson Jr</td>
						<td><i>lorenzodevonj@yahoo.com</i></td>
					</tr>
					<tr>
						<td>Treasurer</td>
						<td>Deborah Jackson</td>
						<td><i>jacksond1961@yahoo.com</i></td>
					</tr>
					<tr>
						<td>Correspondence</td>
						<td>Mia Jackson</td>
						<td><i>kamhya@gmail.com</i></td>
					</tr>
					<tr>
						<td>Correspondence</td>
						<td>Tawana Craig</td>
						<td><i>tawanacraig69@gmail.com</i></td>
					</tr>
					<tr>
						<td>Correspondence</td>
						<td>Lavern Battle</td>
						<td><i></i></td>
					</tr>
					<tr>
						<td>Web Designer</td>
						<td>Tramaine Jackson</td>
						<td><i>jackson.tramaine3@yahoo.com</i></td>
					</tr>
				</table>
				<a id="fb_link" href="https://www.facebook.com/groups/129978977047141/" target="_blank">
					<button>Jackson/Green Facebook Page Click Here</button>
				</a>	
			</div>
		</div>
		<hr/>
		<div class="reunion_content" id='payment_information'>
			<h2 id="payment_information_header">Payment Information</h2>
			<div id="payment_content">
				<div id="paper_payment_option" class="payment_option">
					<h2>Paper Payment</h2>
					<p>Please make all checks payable to Jackson-Green Family Reunion. Checks can be sent to:</p>
						<p id="checks_address"><span>Address:</span><span>5643 Broomall Street</span><span>Philadelphia, PA 19143</span></p>
						<p class="paymentsFinePrint">*Partial payments accepted</p>
						<p class="paymentsFinePrint">*Any return checks will incur a $30 penalty fee</p>
						<p>Click <a href="../files/FR_2016_Registration_From_v3.docx">here</a> to download the registration form.</p>
					</p>
				</div>
				<div id="electronic_payment_option" class="payment_option">
					<h2>Electronic Payment</h2>
					<p>All electronic payments can be sent to administrator@jgreunion.com for anyone who already has a paypal account.</p>
					<p>Click <a href="https://www.paypal.com" target="_blank">here</a> to go to paypal.</p>
				</div>
				<div id="registrationReminderMsg">
					<p>Please do not send any payment without completing the registration form first. You can click <span id="registrationLink">here</span> to complete your registration for the upcoming reunion.</p>
				</div>
			</div>
		</div>	
	</div>
	<div id="footer">
		<p id="footer_info">
			<span id="created_by">Created By: Tramaine Jackson</span>
			<span id="created_date">Created Date: July 2015</span>
			<span id="page_title">Title: Jackson/Green Reunion</span>
		</p>
	</div>
	
	<script>
	if(window.name == "Register"){
		$("#registrationFormBtn").css({
			"box-shadow":"initial", 
			"border":"solid 2px white",
			"fontSize":"120%",
			"width":"11%"
		});
		
		$("#registration_modal, #overlay_PhillyPage").show("slow", function(event)
		{
			var tableInputWidth = $(".table_input").width();
			$("#registration_modal").animate({top:"1%"}, "slow");
			$("#registrationFormTable th:not(#registrationFormTable th:first-of-type)").css({"width":tableInputWidth+"px"});
			$("#name").focus();
		});
	}
	else
	{
		setTimeout(function(e)
		{
			var regBtn = $("#registrationFormBtn");
			regBtn.animate({fontSize:"120%"}, "slow", function(e)
			{
				//regBtn.text("Click here to complete the registration");
				regBtn.css({"box-shadow":"initial"});
			});
			regBtn.animate({width:"11%"}, "slow", function(e)
			{
				setTimeout(function()
				{
					regBtn.css({"border":"solid 2px white"});
				}, 1000)
			});
			
		}, 2000);
	}
	</script>
@endsection