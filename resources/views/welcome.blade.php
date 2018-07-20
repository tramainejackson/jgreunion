@extends('layouts.app')

@section('add_styles')
	<style>
		ul#past_reunions {
			padding: 2% 0%;
			background: radial-gradient(green, green, darkgreen);
			border-radius: 5px;
			color: whitesmoke;
		}
		
		nav {
			position: absolute;
			right: 0;
			margin: 1% 2%;
			z-index: 10;
		}
	
		.carousel-inner, .carousel-item, .carousel-item .view {
			height: 100%;
		}
		
		.carousel-caption {
			max-width: 40%;
			left: 30%;
		}
		
		html,
		body,
		header,
		.carousel {
			height: 60vh;
		}

		@media (max-width: 740px) {
			html,
			body,
			header,
			.carousel {
				height: 100vh;
			}
		}

		@media (min-width: 800px) and (max-width: 850px) {
			html,
			body,
			header,
			.carousel {
			  height: 100vh;
			}
		}

		@media (min-width: 800px) and (max-width: 850px) {
			.navbar:not(.top-nav-collapse) {
				background: #929FBA!important;
			}
		}
	</style>
@endsection

@section('content')
	<div id="jgreunion_page">
	
		<!--Carousel Wrapper-->
		<div id="carousel_home" class="carousel slide carousel-fade" data-ride="carousel">	
		
			<!--Slides-->
			<div class="carousel-inner" role="listbox">
				<nav class="nav nav-pills justify-content-end">
					@if(!Auth::check())
						<!-- <a href='/register' class='profileLink nav-link'>Register</a> -->
						<a href='/login' class='profileLink nav-link'>Login</a>
					@else
						@if(!Auth::user()->is_admin())
							
							<a href='/profile' class='profileLink nav-link'>My Profile</a>
						@else
							
							<!-- <a href='/profile' class='profileLink nav-link'>My Profile</a> -->
							
							<a href='/administrator' class='profileLink adminLink nav-link'>Admin</a>
						@endif
						
						<a href="{{ route('logout') }}" class="profileLink nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
			
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					@endif
				</nav>
			
				@foreach($images as $image)
					<!--Slides-->
					<div class="carousel-item{{ $loop->first ? ' active' : '' }}">
					
						<div class="view bgrd-attr" style="background-image:url('{{ asset($image->path) }}');">

							<div class="mask rgba-black-slight flex-center">
								
								<div class="">
								
									@if($image->description)
									
										<h2 class='image_caption_header'>{{ $image->description }}</h2>
									
									@endif
									
								</div>
								
							</div>
							
						</div>
						
					</div>
					<!--/Slides-->
				@endforeach
				
			</div>
			<!--/.Slides-->
			
			<!--Controls-->
			<a class="carousel-control-prev" href="#carousel_home" role="button" data-slide="prev">
			
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
				
			</a>
			
			<a class="carousel-control-next" href="#carousel_home" role="button" data-slide="next">
			
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
				
			</a>
			<!--/.Controls-->
		</div>
		<!--/.Carousel Wrapper-->
	</div>
	
	<div id="jgreunion_past_future" class="white">
		<ul id="jgreunion_past_future_list" class="container-fluid py-3 m-0">
			<li class="row pb-3">
				<div class="col-12 col-md-6 mb-3 mb-md-0 mx-auto">
					<a href="/upcoming_reunion/{{ $newReunionCheck->count() > 0 ? $newReunionCheck->id : '#' }}" id="upcoming_btn" class="btn btn-lg d-block mt-2{{ $newReunionCheck->count() < 1 ? ' noActive' : '' }}">Upcoming Reunion - {{ $newReunionCheck->count() > 0 ? ucwords($newReunionCheck->reunion_city) . ' ' . $newReunionCheck->reunion_year : 'No Reunion Set Yet' }}</a>
				</div>

				<div class="col-12 col-md-6 mx-auto">
					<button id="past_btn" class="collapsed btn btn-lg w-100 m-0 mt-2" type="button" data-toggle="collapse" data-target="#past_reunions" aria-expanded="false" aria-controls="collapseExample">Past Reunions</button>
				</div>
				<div class="d-none d-md-flex col-md-6"></div>
				<div class="col-12 col-md-6 mx-auto">
					<ul id="past_reunions" class="collapse list-unstyled text-center">
						@foreach($reunions as $pastReunion)
							@if($pastReunion->reunion_complete == "Y")
								@if($pastReunion->has_site == "Y")
									<li class="pastReunion"><a class="pastReunionSite" href="/past_reunion/{{ $pastReunion->id }}" style="color: aquamarine;" target="_blank">{{ $pastReunion->reunion_year }} - {{ $pastReunion->reunion_city }}, {{ $pastReunion->reunion_state }}</a></li>
								@else
									<li class="pastReunion">{{ $pastReunion->reunion_year }} - {{ $pastReunion->reunion_city }}, {{ $pastReunion->reunion_state }}</li>
								@endif
							@endif
						@endforeach
					</ul>
				</div>
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
		held at Salem Baptist Church in Fort Motte, South Carolina with Brother Sandy Jackson presiding over the service.<br/><br/>Since the first reunion, 
		Earlean, Victoria and Hattie Mae’s original vision to celebrate family has produced 16 more bi-annual reunions thus far.  Currently the average attendance 
		at the Jackson-Green Family Reunions ranges between 150-200 people. Every two years the Jackson- Green reunion continues the family tradition of uplifting, 
		celebrating, and honoring family.  The family legacy continues in 2016 as the Jackson-Green families come together in Philadelphia, PA.
	</div>
	
	<div id="reunion_descent" class="container-fluid">
		<div class="row">
			<div class="col-12 col-sm-8 col-xl-7">
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
			<div class="col-0 col-sm-4 col-xl-5 align-self-center">
				<img id="family_tree_pic" src="images/funkynewtree.jpg"/>
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
