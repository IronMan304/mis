<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5">
            @if ($toolId)
                Edit Tool
            @else
                Add Tool
            @endif
        </h1>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <form wire:submit.prevent="store" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group local-forms">
                        <label>Name
                            <span class="login-danger">*</span>
                        </label>
                        <input type="text" class="form-control" wire:model="name" placeholder />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group local-forms">
                        <label>Quantity
                            <span class="login-danger">*</span>
                        </label>
                        <input type="text" class="form-control" wire:model="quantity" placeholder />
                    </div>
                </div>
                {{--<div class="col-md-6">
                    <div class="form-group local-forms">
                        <label>Department
							<span class="login-danger">*</span>
						</label>
						<select class="form-control select" wire:model="department_id">
							<option selected value="">--Select--</option>
							@foreach ($departments as $department)
								<option value="{{ $department->id }}">
									{{ $department->name }}
								</option>
							@endforeach
						</select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group local-forms">
                        <label>Price
                            <span class="login-danger">*</span>
                        </label>
                        <input type="text" class="form-control" wire:model="price" placeholder />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group loval-forms">
                        <label>Description
                            <span class="login-danger">*</span>
                        </label>
                        <input type="text" wire:model="description" class="form-control" placeholder />
                    </div>
                </div>--}}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>
</div>
