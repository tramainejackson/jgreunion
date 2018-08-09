@extends('layouts.app')

@section('content')
	<div class="container-fluid" id="profilePage">
	
		@include('admin.nav')

		<div class="row white">
		
			<div class="col-12 d-flex flex-column flex-xl-row align-items-center">
			
				<div class="mt-3 my-xl-4">
					<div class="">
						<a href="{{ route('members.index') }}" class="btn btn-info btn-lg">All Members</a>
					</div>
				</div>
				
				<div class="my-xl-4">
					<div class="ml-3">
						<a href="{{ route('members.create') }}" class="btn btn-info btn-lg">Create New Member</a>
					</div>
				</div>
				
			</div>
			
			<div class="col-12 col-md-10 mx-auto my-2">
			
				@if($duplicates_check !== null)
					
					@foreach($duplicates_check as $duplicate)
					
						<!--Card-->
						<div class="card grey lighten-1 my-2 animated">
						
							<div class="d-flex flex-center">
								<h2 class="py-5">{{ $duplicate->full_name() }}</h2>
							</div>
							
							<!--Card content-->
							<div class="card-body text-center">
							
								@foreach(App\FamilyMember::getDuplicates($duplicate->firstname, $duplicate->lastname, $duplicate->city, $duplicate->state)->get() as $dupe)
									
									<div class="container-fluid animated">
										
										<div class="row flex-column flex-xl-row align-items-center">
											
											<div class="d-flex flex-column align-items-center justify-content-center col-12 col-xl-2">
												<p class="my-1">Has User Profile</p>
												
												@if($dupe->user_id !== null)
													
													<i class="fa fa-check-square green-text" aria-hidden="true"></i>
													
												@else
													
													<i class="fa fa-window-close red-text" aria-hidden="true"></i>
													
												@endif
											</div>
											
											<p class="my-0 col-12 col-xl-2">{{ $dupe->full_name() }}</p>
											
											<p class="my-0 col-12 col-xl-4">{{ $dupe->full_address() }}</p>
											
											<div class="d-flex flex-column align-items-center justify-content-around flex-xl-row col-12 col-xl-4">
											
												<button class="btn btn-rounded red lighten-1 deleteDupe" type="button">Delete
													<input type="text" class="hidden" value="{{ $dupe->id }}" hidden />
												</button>
												
												<button class="btn btn-rounded orange accent-1 keepDupe" type="button">Not A Dupe
													<input type="text" class="hidden" value="{{ $dupe->id }}" hidden />
												</button>
												
											</div>
											
										</div>
										
									</div>
								
									
									<hr class="" {{ $loop->last ? 'hidden' : '' }} />
								
								@endforeach
								
							</div>
							
						</div>
						<!--/.Card-->
						
					@endforeach
					
				@else
				
					<div class="">
					
						<h2 class="">There are no duplicates currently found in the system</h2>
					
					</div>
					
				@endif
				
			</div>
			
		</div>
		
	</div>
@endsection