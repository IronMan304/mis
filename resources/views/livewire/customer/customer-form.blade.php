<div class="modal-content">
	<div class="modal-header">
		<h1 class="modal-title fs-5">
			@if ($customerId)
				Edit Customer
			@else
				Add Customer
			@endif
		</h1>
		<button type="button" class="btn-close btn-sm" id="close-form-button" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	@if ($errors->any())
		{{ implode('', $errors->all('<div>:message</div>')) }}
	@endif
	<form wire:submit.prevent="store" enctype="multipart/form-data">
		<div class="modal-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group local-forms">
						<label>First Name
							<span class="login-danger">*</span>
						</label>
						<input class="form-control" type="text" wire:model="first_name" placeholder />
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group local-forms">
						<label>Middle Name</label>
						<input class="form-control" type="text" wire:model="middle_name" placeholder />
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group local-forms">
						<label>Last Name
							<span class="login-danger">*</span>
						</label>
						<input class="form-control" type="text" wire:model="last_name" placeholder />
					</div>
				</div>
				{{--<div class="col-md-6">
					<div class="form-group local-forms">
						<label>Address
							<span class="login-danger">*</span>
						</label>
						<input class="form-control" type="text" wire:model="address" placeholder />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group local-forms">
						<label>Contact number
							<span class="login-danger">*</span>
						</label>
						<input class="form-control" type="text" wire:model="contact_number" placeholder />
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group local-forms">
						<label>Gender
							<span class="login-danger">*</span>
						</label>
						<select class="form-control select" wire:model="gender_id">
							<option selected value="">--Select--</option>
							@foreach ($genders as $gender)
								<option value="{{ $gender->id }}">
									{{ $gender->name }}
								</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group local-forms">
						<label>Birthdate
							<span class="login-danger">*</span>
						</label>
						<input class="form-control" type="date" wire:model="birthdate" placeholder />
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group local-forms">
						<label>Civil Status
							<span class="login-danger">*</span>
						</label>
						<select class="form-control select" wire:model="civil_status_id">
							<option selected value="">--Select--</option>
							@foreach ($civilStatuses as $civilstat)
								<option value="{{ $civilstat->id }}">
									{{ $civilstat->name }}
								</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row d-flex justify-content-center">
					@if ($customerId)
						<div class="col-md-6">
							<div class="form-group local-forms">
								<label>Blood Type
									<span class="login-danger">*</span>
								</label>
								<select class="form-control select" wire:model="blood_type_id">
									<option selected value="">--Select--</option>
									@foreach ($bloodTypes as $blood)
										<option value="{{ $blood->id }}">
											{{ $blood->name }}
										</option>
									@endforeach
								</select>
							</div>
						</div>
					@endif
				</div>--}}
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary" id="save-form-button">Save</button>
		</div>
	</form>
</div>
