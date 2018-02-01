<div class="modal fade" id="delete_registration" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="">Delete Registration</h2>
			</div>
			<div class="modal-body">
				<p class="">{{ $registration->id }}</p>
				{!! Form::open(['action' => ['RegistrationController@destroy', 'registration' => $registration->id], 'method' => 'DELETE']) !!}
				
					<div class="form-group">
						{{ Form::submit('Delete Registration', ['class' => 'btn btn-primary form-control']) }}
					</div>
				{!! Form::close() !!}
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>