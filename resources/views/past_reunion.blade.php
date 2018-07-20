@extends('layouts.app')

@section('styles')
	<style>
		#reunion_page {
			background: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('{{ asset('storage/' . str_ireplace('public/', '', $reunion->picture)) }}');
		}
		
		#contact_information_header, #hotel_information_header, #activities_information_header {
			color: whitesmoke;
			text-shadow: 2px 1px 10px darkgrey;
		}
	
		.contactContent {
			margin: 0% 2%;
			padding: 1% 10%;
			border-radius: 10px;
			font-weight: bold;
			font-size: 130%;
		}
		
		#hotel_content {
			background: white;
			margin: 0%;
		}
		
		div#hotel_content dl {
			margin: 0%;
			width: 100%;
			font-size: 90%;
		}
	</style>
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
			<div class="col-11 col-lg-9 mx-auto">
				<div class="pastReunionContent" id="hotel_information">
					<h2 id="hotel_information_header">Hotel Information</h2>
					<div id="hotel_content" class="container-fluid">
						<div class="row">
							<div class="col-12 col-lg-3">
								<img id="hotel_pic" src="/images/crowne-plaza-feasterville-trevose.jpg"/>
							</div>
							<div class="col-12 col-lg-9">
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
								</dl>
							</div>
						</div>
					</div>
				</div>

				<hr/>

				<div class="pastReunionContent" id="activities_information">
					<h2 id="activities_information_header">Activities</h2>
					<div class="activities_content p-3 mx-md-5">
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
				
				<div class="pastReunionContent" id="contact_information">
					<h2 id="contact_information_header">Committee Information</h2>
					<div id="" class="bg-white contactContent mx-0 mx-md-3 px-0 px-md-2 table-responsive">
						<table id="contact_information_table" class="table text-center">
							<tr>
								<th><u>Title</u></th>
								<th><u>Name</u></th>
								<th><u>Email Address</u></th>
							</tr>
							@foreach($committee_members as $committee_member)
								<tr>
									<td>{{ ucwords(str_ireplace('_', ' ', $committee_member->member_title)) }}</td>
									<td>{{ ucwords($committee_member->member_name) }}</td>
									<td><i>{{ strtolower($committee_member->member_email) }}</i></td>
								</tr>
							@endforeach
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
								<td class="text-truncate"><i>tawanacraig69@gmail.com</i></td>
							</tr>
							<tr>
								<td>Correspondence</td>
								<td>Lavern Battle</td>
								<td><i></i></td>
							</tr>
						</table>	
					</div>
				</div>	
			</div>
		</div>
		
	</div>
	
	<footer>
		<div class="container-fluid">
			<div class="row">
				<p class="col-4 text-center my-0 py-3">Created By: Tramaine Jackson</p>
				<p class="col-4 text-center my-0 py-3">Created Date: July 2015</p>
				<p class="col-4 text-center my-0 py-3">Title: Jackson/Green Reunion</p>
			</div>
		</div>
	</footer>
@endsection