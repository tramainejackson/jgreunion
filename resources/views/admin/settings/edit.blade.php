 @extends('layouts.app')

@section('content')
	<div class="container-fluid" id="">
	
		@include('admin.nav')
		
		<div class="row white">

			<div class="col-11 col-md-8 my-5 mx-auto">
			
				@if($images->count() < 10)
					
					{!! Form::open(['action' => ['HomeController@update_settings', 'reunion' => 1], 'method' => 'PUT', 'files' => true, 'class' => 'mb-5']) !!}
						
						<div class="">
							<h2 class="">Add Carousel Images</h2>
						</div>
						
						<div class="md-form">
						
							<div class="file-field">
							
								<div class="btn btn-primary btn-sm float-left">
									<span>Choose file</span>
									<input type="file" id="new_picture_file" name="photo[]" multiple="multiple" />
								</div>
								
								<div class="file-path-wrapper">
									<input class="file-path validate" type="text" placeholder="Upload Up To 10 Pictures" />
								</div>
							</div>
						</div>

						<div class="md-form">
							<button class="btn btn-success" type="submit">Add Pictures</button>
						</div>
						
					{!! Form::close() !!}
				
				@else
					
					<div class="">
						<h2 class="">Max number of images have been added</h2>
					</div>
				
				@endif
				
				<hr/>
				
				@if($images->isNotEmpty())
					
					<div class="row">
					
						<div class="col-12 mt-5">
							<h2 class="">Current Images</h2>
						</div>
						
						@foreach($images as $image)
					
							<div class="col-12 col-md-6 col-lg-4 my-1">
								{!! Form::open(['action' => ['HomeController@update_carousel', 'picture' => $image->id], 'method' => 'PATCH']) !!}
								
									<!--Card-->
									<div class="card">
									
										<!--Card image-->
										<div class="view">
											<img src="{{ asset($image->path) }}" class="img-fluid" alt="photo">
											<a href="#">
												<div class="mask rgba-white-slight"></div>
											</a>
										</div>
										
										<!--Card content-->
										<div class="card-body text-center">
										
											<!--Title-->
											<h4 class="card-title">Description</h4>
											
											<!--Input-->
											<div class="md-form">
												<textarea  name="description" class="md-textarea form-control" placeholder="Enter A Description For The Picture">{{ $image->description }}</textarea>
											</div>
											
											<div class="md-form">
												<input class="hidden" value="{{ $image->id }}" hidden />
											</div>
											
											<button class="btn btn-primary" type="submit">Update</button>
											
											<button class="btn btn-danger deleteCarousel" type="button"data-toggle="modal" data-target="#pictureConfirmDelete">Delete</button>
										</div>
										
									</div>
									<!--/.Card-->
								
								{!! Form::close() !!}
								
							</div>
							
						@endforeach
					
					</div>
					
				@endif
				
			</div>
			
		</div>
		
		<!--Modal: modalConfirmDelete-->
		<div class="modal fade" id="pictureConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
			
				{!! Form::open(['action' => ['HomeController@delete_carousel', 'picture' => 'null'], 'method' => 'DELETE']) !!}
				
					<!--Content-->
					<div class="modal-content text-center">
						<!--Header-->
						<div class="modal-header d-flex justify-content-center">
							<p class="heading">Are you sure you want to delete this image?</p>
						</div>

						<!--Body-->
						<div class="modal-body"></div>

						<!--Footer-->
						<div class="modal-footer flex-center">
							<button type="submit" class="btn btn-outline-danger">Yes</button>
							
							<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No</a>
						</div>
						
					</div>
					<!--/.Content-->
					
				{!! Form::close() !!}
				
			</div>
			
		</div>
		<!--Modal: modalConfirmDelete-->
			
	</div>
@endsection