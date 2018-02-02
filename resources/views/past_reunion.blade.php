@extends('layouts.app')

@section('styles')
	@include('function.bootstrap_css')
	<style>
		#reunion_page {
			background: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('{{ asset('storage/' . str_ireplace('public/', '', $reunion->picture)) }}');
		}
	</style>
@endsection

@section('scripts')
	@include('function.bootstrap_js')
@endsection

@section('content')
	<div id="reunion_page" class="container-fluid">
		<div class="row mb-2">
			<div class="col">
				<div id="page_header" style="margin: 0px -15px;">
					<h1 id="jgphilly_page_header" class=" py-2">Jackson/Green Family Reunion {{ $reunion->reunion_year }}</h1>
					<h2 id="jgphilly_page_header" class="my-0 py-0 pb-2">{{ $reunion->reunion_city . ' ' . $reunion->reunion_state }}</h2>
				</div>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-8 mx-auto">
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
					</div>
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
@endsection