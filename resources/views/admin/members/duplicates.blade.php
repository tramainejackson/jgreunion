@extends('layouts.app')

@section('content')
	<div class="container-fluid" id="profilePage">
	
		@include('admin.nav')

		<div class="row white">
		
			<div class="col-12 d-flex align-items-center">
			
				<div class="my-4">
					<div class="">
						<a href="{{ route('members.index') }}" class="btn btn-info btn-lg">All Members</a>
					</div>
				</div>
				
				<div class="my-4">
					<div class="ml-3">
						<a href="{{ route('members.create') }}" class="btn btn-info btn-lg">Create New Member</a>
					</div>
				</div>
				
			</div>
			
			<div class="col-8 mx-auto my-2">
			
				@foreach($duplicates_check as $duplicate)
				
					<!--Card-->
					<div class="card default-color-dark my-2">
					
						<div class="d-flex flex-center">
							<h2 class="py-5">{{ $duplicate->full_name() }}</h2>
						</div>
						
						<!--Card content-->
						<div class="card-body text-center">
						
							@foreach(App\FamilyMember::getDuplicates($duplicate->firstname, $duplicate->lastname, $duplicate->city, $duplicate->state) as $dupe)
								
								<div class="d-flex align-items-center justify-content-center">
									
									<div class="d-flex flex-column align-items-center justify-content-center">
										<p class="">Has User Profile</p>
										
										@if($dupe->user_id !== null)
											
											<i class="fa fa-check-square" aria-hidden="true"></i>
											
										@else
											
											<i class="fa fa-window-close" aria-hidden="true"></i>
											
										@endif
									</div>
									
									<p class="mx-2 my-0">{{ $dupe->full_name() }}</p>
									
									<p class="mx-2 my-0">{{ $dupe->full_address() }}</p>
									
									<button class="btn btn-rounded red lighten-1" type="button">Delete</button>
									
									<button class="btn btn-rounded orange accent-1" type="button">Not A Dupe</button>
								</div>
							
							@endforeach
							
						</div>
						
					</div>
					<!--/.Card-->
					
				@endforeach
			</div>
		</div>
	</div>
@endsection