<div class="modal fade delete_registration{{ $loop->iteration }}" id="" tabindex="-1" role="dialog" aria-labelledby="deleteRegistrationModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		{!! Form::open(['action' => ['RegistrationController@destroy', 'registration' => $registration->id], 'method' => 'DELETE']) !!}
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="">Delete Registration</h2>
				</div>
				<div class="modal-body">
					<div class="form-row my-2">
						<label class="form-label col-12">Registrations</label>
						@if($family->isNotEmpty())
							@foreach($family as $family_member)
								<div class="form-group col-6">
									<input type="text" class="form-control" value="{{ $family_member->firstname . ' ' . $family_member->lastname }}" disabled />
								</div>
								<div class="form-group col-6">
									<input type="text" class="form-control" value="{{ ucwords($family_member->age_group) }}" disabled />
								</div>
							@endforeach
						@else
							<div class="form-group col-12">
								<input type="text" class="form-control" value="{{ $registration->registree_name }}" disabled />
							</div>
						@endif
					</div>
					<div class="form-row my-2">
						<div class="form-group col-6">
							<label class="form-label">Due</label>
							<input type="text" class="form-control" value="${{ $registration->total_amount_due }}" disabled />
						</div>
						<div class="form-group col-6">
							<label class="form-label">Paid</label>
							<input type="text" class="form-control" value="${{ $registration->total_amount_paid == null ? '0' : $registration->total_amount_paid }}" disabled />
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-12">
							<label class="form-label">Notes</label>
							<textarea class="form-control" placeholder="No Registration Notes" disabled>{{ $registration->reg_notes }}</textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group w-100">
						{{ Form::submit('Confirm', ['class' => 'btn btn-danger form-control']) }}
					</div>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>