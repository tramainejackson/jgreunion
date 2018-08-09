@extends('layouts.app')

@section('add_styles')
	<link rel="stylesheet" href="{{ asset('css/addons/datatables.min.css') }}">
@endsection

@section('content')
	<div class="container-fluid" id="profilePage">
		
		@include('admin.nav')
		
		<div class="row white" id="distribution_list">
		
			<div class="col-12 d-flex align-items-center justify-content-center justify-content-md-start">
			
				<div class="my-4">
					<div class="">
						<a href="/members/create" class="btn btn-info btn-lg">Create New Member</a>
					</div>
				</div>
				
				@if($duplicates !== null)
					<div class="my-4">
						<div class="ml-3">
							<a href="{{ route('duplicate_members') }}" class="btn btn-lg blue darken-2">Check Duplicates</a>
						</div>
					</div>
				@endif
				
				<!-- <div class="my-4">
					<div class="ml-5">
						<div class="input-group input-group-lg">
						
							<input type="text" name="" class="memberFilter form-control" value="" placeholder="Filter By Name" />
							
							<div class="input-group-prepend">
								<i class="fa fa-search input-group-text" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div> -->
				
			</div>
			
			<div class="col-12">
			
				<div class="">
				
					<table id="family_members_table" class="table table-striped table-hover" cellspacing="0" width="100%">
					
						<thead>
							<tr>
								<th class="th-sm">
									<div class="d-flex align-items-center justify-content-between">
										<span>Firstname</span>
										<i class="fa fa-sort" aria-hidden="true"></i>
									</div>
								</th>
								
								<th>
									<div class="d-flex align-items-center justify-content-between">
										<span>Lastname</span>
										<i class="fa fa-sort float-right" aria-hidden="true"></i>
									</div>
								</th>
								
								<th>
									<div class="d-flex align-items-center justify-content-between">
										<span>Address</span> 
										<i class="fa fa-sort float-right" aria-hidden="true"></i>
									</div>
								</th>
								
								<th>
									<div class="d-flex align-items-center justify-content-between">
										<span>City</span>
										<i class="fa fa-sort float-right" aria-hidden="true"></i>
									</div>
								</th>
								
								<th>
									<div class="d-flex align-items-center justify-content-between">
										<span>State</span>
										<i class="fa fa-sort float-right" aria-hidden="true"></i>
									</div>
								</th>
								
								<th>
									<div class="d-flex align-items-center justify-content-between">
										<span>Zip</span>
										<i class="fa fa-sort float-right" aria-hidden="true"></i>
									</div>
								</th>
								<th>
									<div class="d-flex align-items-center justify-content-between">
										<span>Phone</span>
										<i class="fa fa-sort float-right" aria-hidden="true"></i>
									</div>
								</th>
								
								<th>
									<div class="d-flex align-items-center justify-content-between">
										<span>Email</span> 
										<i class="fa fa-sort float-right" aria-hidden="true"></i>
									</div>
								</th>
								<th class="text-center">Preference</th>
								<th class="text-center">Notes</th>
								<th class="text-center">Edit</th>
							</tr>
						</thead>
						
						<tbody>
						
							@foreach($distribution_list as $member)
								<tr>
									<td class="text-truncate nameSearch">{{ $member->firstname }}</td>
									<td class="text-truncate nameSearch">{{ $member->lastname }}</td>
									<td class="text-truncate">{{ $member->address }}</td>
									<td class="text-truncate">{{ $member->city }}</td>
									<td class="text-truncate">{{ $member->state }}</td>
									<td class="text-truncate">{{ $member->zip }}</td>
									<td class="text-truncate">{{ $member->phone }}</td>
									<td class="text-truncate">{{ $member->email }}</td>
									<td class="text-truncate text-center" data-toggle="tooltip" data-placement="left" title="{{ $member->mail_preference == 'M' ? 'Mail' : 'Email' }}">{{ $member->mail_preference }}</td>
									<td class="text-truncate" data-toggle="tooltip" data-placement="left" title="{{ $member->notes }}">{{ $member->notes != null ? 'Y' : 'N' }}</td>
									<td class="text-truncate"><a href="/members/{{ $member->id }}/edit" class="btn btn-warning btn-rounded btn-block">Edit</a></td>
								</tr>			
							@endforeach
							
						</tbody>
						
					</table>
					
				</div>
				
			</div>			
		</div>
	</div>
@endsection