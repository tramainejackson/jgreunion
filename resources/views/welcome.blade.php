@extends('layouts.app')

@section('styles')
	@include('function.bootstrap_css')
@endsection

@section('scripts')
	@include('function.bootstrap_js')
@endsection

@section('content')
	<div id="jgreunion_page">
		<div id="navi">
			<div class="container-fluid">
				<div class="row">
					<div class="col">
						<nav class="nav nav-pills justify-content-end">
							@if(!Auth::check())
								<a href='/registration' class='profileLink nav-link'>Register</a>
								<a href='/login' class='profileLink nav-link'>Login</a>
							@else
								<a href='/profile' class='profileLink nav-link'>My Profile</a>
								<a href='/logout' class='profileLink nav-link'>Logout</a>
							@endif
						</nav>
					</div>
				</div>
			</div>
			
			<div id="family_account" class="mt-5">
				<div class="page_header">
					<h1 class="text-center display-3 my-5">Jackson &amp; Green Family Reunion</h1>
				</div>
			</div>
			
			@foreach($images as $image)
				@if($image->id == 6)
					<h2 class='showing_image image_caption_header'>{{ $image->image_description }}</h2>
				@else
					<h2 class='image_caption_header'>{{ $image->image_description }}</h2>							
				@endif
			@endforeach
		</div>
		<div id="image_slide_show">
			@foreach($images as $image)
				@if($image->id == 6)
					<div class='image_div showing_image' style='background-image:url("{{ $image->image_root }}/{{ $image->image_name }}.{{ $image->image_suffix}}");'>
					<img class='slideShowImage' src='placeholder.jpg' /></div>
				@else
					<div class='image_div' style='background-image:url("{{ $image->image_root }}/{{ $image->image_name }}.{{ $image->image_suffix }}");'>
					echo "<img class='slideShowImage' src='placeholder.jpg' /></div>
				@endif
			@endforeach
		</div>
	</div>
	<div id="jgreunion_past_future">
		<ul id="jgreunion_past_future_list">
			<li><button id="upcoming_btn" class="past_future_btn">Upcoming Reunion 2018 - Charlotte</button></li>
			<li><button id="past_btn" class="past_future_btn">Past Reunions</button>
				<ul id="past_reunions">
					@foreach($reunions as $pastReunion)
						@if($pastReunion->reunion_complete == "Y")
							@if($pastReunion->has_site == "Y")
								<li class="pastReunion"><a class="pastReunionSite" href="/past_reunion/{{ $pastReunion->id }}" target="_blank">{{ $pastReunion->reunion_year }} - {{ $pastReunion->reunion_city }}, {{ $pastReunion->reunion_state }}</a></li>
							@else
								<li class="pastReunion">{{ $pastReunion->reunion_year }} - {{ $pastReunion->reunion_city }}, {{ $pastReunion->reunion_state }}</li>
							@endif
						@endif
					@endforeach
				</ul>
			</li>
		</ul>	
	</div>
	<div id="reunion_history">
		<img id="reunion_history_pic" src="images/BlackHistory2015_037.jpg"/> 
		<p>To The Jackson Green Family,<br/><br/>Earlean Jackson, Victoria Jackson Darby and Hattie Mae Jackson Green, started the Jackson-Green Family 
		Reunion in the winter of 1982.<br/><br/>In beginning of forming the family reunion tradition, Earlean, Hattie Mae and Victoria knew that they 
		wanted a family reunion but didn’t want to be partial to either side of the family. Therefore the decision was made to form the family reunion 
		with both the Jackson (father’s line of decent) and Green (mother’s line of decent) families. <br/><br/>The first family reunion was held on the 
		second weekend of August in 1982.  The reunion started with a barbeque on Friday in the backyard of Victoria's home in St. Matthew, South Carolina. 
		On the following day, a program and dinner was held at the local middle school. Closing the family reunion weekend, on Sunday, a church services was 
		held at Mount Salem Baptist Church in Fort Knox, South Carolina with Rev. Sandy Jackson presiding over the service.<br/><br/>Since the first reunion, 
		Earlean, Victoria and Hattie Mae’s original vision to celebrate family has produced 16 more bi-annual reunions thus far.  Currently the average attendance 
		at the Jackson-Green Family Reunions ranges between 150-200 people. Every two years the Jackson- Green reunion continues the family tradition of uplifting, 
		celebrating, and honoring family.  The family legacy continues in 2016 as the Jackson-Green families come together in Philadelphia, PA.
	</div>
	<div id="reunion_descent">
		<img id="family_tree_pic" src="images/funkynewtree.jpg"/>
		<div id="jackson_descent" class="reunion_descent_info">
			<h2 id="jackson_descent_header" class="descent_info">Jackson Line of Descent</h2>
			<p>Rev. Sandy Jackson II and his wife Venus, had nine children and forty grandchildren come from their union.</p>
			<ol>
				<li>Louis Jackson (six children)</li>
				<li>Darryl Jackson (two children)</li>
				<li>Willie &quot;HIT&quot; Jackson (two children)</li>
				<li>Chair Jackson (one child)</li>
				<li>Mary Magdalene Jackson (three children)</li>
				<li>Cyrus &quot;Blump&quot; Jackson (eight children)</li>
				<li>Sally Jackson</li>
				<li>Sandy Jackson (nine children)</li>
				<li>Hattie Jackson (nine children)</li>
			</ol>
		</div>
		<div class="reunion_descent_info" id="green_descent">
			<h2 id="green_descent_header" class="descent_info">Green Line of Descent</h2>
			<p>From the union of Peter and Laura Green, there were eight children and fifty-six grandchildren.</p>
			<ol>
				<li>Davis Green</li>
				<li>Richard Green (four children)</li>
				<li>Louis Green (five children)</li>
				<li>Senda Green</li>
				<li>Nancy Green (six children)</li>
				<li>Anna Green (eleven children)</li>
				<li>Peggy Green (eleven children)</li>
				<li>Victoria Angus Green (eleven children)</li>
			</ol>
			<p>It was from the union of Sandy Jackson (Rev. Sandy and Venus Jackson’s son) and Clander Green<br/>(Peter and Laura Green’s daughter) that brought the Jackson-Green families together.</p>
		</div>						
	</div>
	<div id="footer">
		<p id="footer_info"><span id="created_by">Created By: Tramaine Jackson</span><span id="created_date">Created Date: July 2015</span><span id="page_title">Title: Jackson/Green Reunion</span></p>
	</div>
@endsection
