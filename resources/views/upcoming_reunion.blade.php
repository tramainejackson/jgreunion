@extends('layouts.app')

@section('styles')
	@include('function.bootstrap_css')
@endsection

@section('scripts')
	@include('function.bootstrap_js')
@endsection

@section('content')
	<div id="scroll_to_top"></div>
	<div id="registration_btn">
		<button id="registrationFormBtn">
			<span id="registrationFormSpan">Click here to complete the registration.</span>
		</button>
	</div>
	<div id="registration_modal"></div>
	<div id="reunion_page" class="container-fluid">
		<div id="row">
			<div class="col">
				<h1 id="text-center">Jackson/Green Family Reunion {{ $reunion->reunion_year }}</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-2">
				
			</div>
			<div class="col-8">
				<!-- Hotel information -->
				<div class="row reunion_content" id="hotel_information">
					<h2 id="hotel_information_header" class="col-12">Hotel Information</h2>
					<div id="hotel_content" class="col-12">
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
				
				<!-- Activities information -->
				<div class="row reunion_content" id="activities_information">
					<h2 id="activities_information_header">Activities</h2>
					<div class="activities_content">
						@foreach($events as $events)
							@foreach($events as $event)
								@if($loop->first)<h2 class="">{{ $event->event_date }}</h2>@endif
								@if($loop->first)<ul class="">@endif
									<li class=""></li>
									<li class="">{{ $event->event_location }}</li>
									<li class="">{{ $event->event_description }}</li>
									<li class=""></li>
								@if($loop->last)</ul>@endif
							@endforeach
						@endforeach
					</div>
				</div>
				
				<hr/>
				
				<!-- Contact/Committee information -->
				<div class="row reunion_content" id="">
					<h2 id="" class="col-12">Committee Information</h2>
					<div id="col-12">
						<table id="" class="table">
							<tr>
								<th><u>Title</u></th>
								<th><u>Name</u></th>
								<th><u>Email Address</u></th>
							</tr>
							
							@foreach($committee_members as $committee)
								<tr>
									<td>{{ $committee->member_title }}</td>
									<td>{{ $committee->member_name }}</td>
									<td><i>{{ $committee->member_email }}</i></td>
								</tr>
							@endforeach
							
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
				
				<div class="row reunion_content" id="payment_information">
					<div class="col-12">
						<h2 class="text-center">Payment Information</h2>
					</div>
					<div id="paper_payment_option" class="payment_option col-5 mx-auto">
						<h2>Paper Payment</h2>
						<p>Please make all checks payable to Jackson-Green Family Reunion. Checks can be sent to:</p>
						<p id="checks_address"><span>Address:</span><span>{{ $committee_president->address }}</span><span>{{ $committee_president->city. ', ' . $committee_president->state . ' ' .$committee_president->zip }}</span></p>
						<p class="paymentsFinePrint">*Partial payments accepted</p>
						<p class="paymentsFinePrint">*Any return checks will incur a $30 penalty fee</p>
						<p>Click <a href="../files/FR_2016_Registration_From_v3.docx">here</a> to download the registration form.</p>
					</div>
					<div id="electronic_payment_option" class="payment_option col-5 mx-auto">
						<h2>Electronic Payment</h2>
						<p>All electronic payments can be sent to administrator@jgreunion.com for anyone who already has a paypal account.</p>
						<p>Click <a href="https://www.paypal.com" target="_blank">here</a> to go to paypal.</p>
					</div>
					<div class="col-12" id="registrationReminderMsg">
						<p>Please do not send any payment without completing the registration form first. You can click <span id="registrationLink">here</span> to complete your registration for the upcoming reunion.</p>
					</div>
				</div>
				
				<hr/>
				
				<!-- Registered Members For This Reunion -->
				<div class="row reunion_content" id="registered_members_information">
					<h2 class="col-12">Registered Family Members</h2>
					<div class="col-12">
						@foreach($registrations as $registration)
							<ul class="list-unstyled">
								<li class="">{{ $registration->registree_name }}</li>
								@if($registration->family_id != null)
									@php 
										$family_members = \App\Reunion_dl::where('family_id', $registration->family_id)->get();
									@endphp
									<li class="">
										<ul class="list-unstyled">
											@foreach($family_members as $family_member)
												<li class="">{{ $family_member->firstname }}</li>
											@endforeach
										</ul>
									</li>
								@endif
							</ul>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-2">
				
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