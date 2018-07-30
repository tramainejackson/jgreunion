@extends('layouts.app')

@section('content')
	<div class="container-fluid" id="profilePage">
		
		@include('admin.nav')
		
		<div class="row white" id="distribution_list">
		
			<div class="col-12 d-flex align-items-center">
			
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
				
				<div class="my-4">
					<div class="ml-5">
						<div class="input-group input-group-lg">
							<input type="text" name="" class="memberFilter form-control" value="" placeholder="Filter By Name" />
							<div class="input-group-prepend">
								<span class="oi oi-magnifying-glass input-group-text"></span>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			
			<div class="col-12">
			
				<div class="table-wrapper">
				
					<table class="table table-striped table-hover">
					
						<thead>
							<tr>
								<th>Firstname</th>
								<th>Lastname</th>
								<th>Address</th>
								<th>City</th>
								<th>State</th>
								<th>Zip</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Preference</th>
								<th>Notes</th>
								<th>Edit</th>
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
									<td class="text-truncate" data-toggle="tooltip" data-placement="left" title="{{ $member->mail_preference == 'M' ? 'Mail' : 'Email' }}">{{ $member->mail_preference }}</td>
									<td class="text-truncate" data-toggle="tooltip" data-placement="left" title="{{ $member->notes }}">{{ $member->notes != null ? 'Y' : 'N' }}</td>
									<td class="text-truncate"><a href="/members/{{ $member->id }}/edit" class="btn btn-warning">Edit</a></td>
								</tr>			
							@endforeach
							
						</tbody>
						
					</table>
					
				</div>
				
			</div>			
		</div>
	</div>
@endsection