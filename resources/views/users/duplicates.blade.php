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
			
			<div class="col-12 col-md-10 mx-auto my-2 duplicatesCol animated">
			
				@if($duplicates_check !== null)
					
					@foreach($duplicates_check as $duplicate)
						@php 
							$firstAccount = App\FamilyMember::getDuplicates($duplicate->firstname, $duplicate->lastname, $duplicate->city, $duplicate->state)->first();
						@endphp
						
						<!--Card-->
						<div class="card grey lighten-1 my-2 animated">
						
							<div class="d-flex flex-center justify-content-center my-3">
								
								<!-- Member Profile Avatar -->
								<div class="mx-4">
									<img src="{{ asset($duplicate->avatar ? $duplicate->avatar : '/images/img_placeholder.jpg' ) }}" class="img-fluid" height="350px" width="250px" />
								</div>
								
								<!-- Bio Info -->
								<div class="mx-4">
									<h3 class="h3-responsive"><span class="font-weight-bold pr-3">Name:</span><span class="text-muted">{{ $firstAccount->full_name() }}</span></h3>
									
									<h3 class="h3-responsive"><span class="font-weight-bold pr-3">Address:</span><span class="text-muted">{{ $firstAccount->full_address() }}</span></h3>
									
									<h3 class="h3-responsive"><span class="font-weight-bold pr-3">Email:</span><span class="text-muted">{{ $firstAccount->email != null ? $firstAccount->email : 'No Email Address' }}</span></h3>
									
								</div>
								
							</div>
							
							<!--Card content-->
							<div class="card-body text-center">
								@foreach(App\FamilyMember::getDuplicates($duplicate->firstname, $duplicate->lastname, $duplicate->city, $duplicate->state)->get() as $dupe)
									
									@if($loop->iteration != 1)
										
										<div class="container-fluid animated">
											
											<div class="row flex-column flex-xl-row align-items-center justify-content-around">
												
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
								
									@endif
									
									<hr class="" {{ $loop->last ? 'hidden' : '' }} />
								
								@endforeach
								
							</div>
							
						</div>
						<!--/.Card-->
						
					@endforeach
					
				@else
				
					<div class="text-center">
					
						<h2 class="text-center">There are no duplicates currently found in the system</h2>
					
					</div>
					
				@endif
				
			</div>
			
		</div>
		
	</div>
@endsection