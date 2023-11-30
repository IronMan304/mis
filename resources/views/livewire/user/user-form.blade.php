<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5">
            @if ($userId)
                Edit User
            @else
                Add User
            @endif
        </h1>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    @if ($errors->any())
    <span class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </span>
    @endif
    <form wire:submit.prevent="store" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group local-forms">
                                <label>
                                    First Name
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
                                <label>
                                    Last Name
                                    <span class="login-danger">*</span>
                                </label>
                                <input class="form-control" type="text" wire:model="last_name" placeholder />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group local-forms">
                                <label>
                                    Username
                                    <span class="login-danger">*</span>
                                </label>
                                <input class="form-control" type="text" wire:model="username" placeholder />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group local-forms">
                                <label>
                                    Email
                                    <span class="login-danger">*</span>
                                </label>
                                <input class="form-control" type="email" wire:model="email" placeholder />
                            </div>
                        </div>
                    </div>
                    @if (!isset($userId))
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group local-forms">
                                    <label>
                                        Password
                                        <span class="login-danger">*</span>
                                    </label>
                                    <input class="form-control" type="password" wire:model="password" placeholder />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group local-forms">
                                    <label>
                                        Confirm Password
                                        <span class="login-danger">*</span>
                                    </label>
                                    <input class="form-control" type="password" wire:model="password_confirmation"
                                        placeholder />
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($userId)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group local-forms">
                                        <label>New Password</label>
                                        <input class="form-control" type="password" wire:model="password" placeholder />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group local-forms">
                                        <label>Confirm New Password</label>
                                        <input class="form-control" type="password" wire:model="password_confirmation" placeholder />
                                    </div>
                                </div>
                            </div>
                        @endif


                   

                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <div class="table-responsive">
                                <table class="table border-0 custom-table comman-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 30%"></th>
                                            <th style="width: 70%">Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($selectedRoles))
                                        @foreach ($roles as $role)
                                        <tr>
                                            <td>
                                                <input type="checkbox" wire:model.defer="selectedRoles"
                                                    class="form-input" value="{{ $role->id }}" {{ in_array($role->id,
                                                $selectedRoles) ? 'checked' : '' }}>
							</td>
							<td>
								<span class="text-capitalize">{{ $role->name }}</span>
							</td>
							</tr>
							@endforeach
							@else

							@endif
							</tbody>
							</table>
						</div> --}}
                            <div style="height: 150px; overflow-y: scroll;">
                                @if (empty($selectedRoles))
                                    @forelse ($roles as $role)
                                        <div class="form-check mb-2">
                                            <input wire:model.defer="roleCheck" type="checkbox" class="form-check-input"
                                                value="{{ $role->name }}" id="{{ $role->name }}">
                                            <label class="form-check-label text-capitalize" for="{{ $role->name }}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    @empty
                                        <p>No roles found</p>
                                    @endforelse
                                @else
                                    @forelse ($roles as $role)
                                        <div class="form-check mb-2">
                                            <input wire:model.defer="selectedRoles" type="checkbox"
                                                class="form-check-input" value="{{ $role->name }}"
                                                id="{{ $role->name }}"
                                                {{ in_array($role->name, $selectedRoles) ? 'checked' : '' }}>
                                            <label class="form-check-label text-capitalize" for="{{ $role->name }}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    @empty
                                        <p>No roles found</p>
                                    @endforelse
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

				
            </div>
            <div class="row @if(isset($userId)) mt-5 @else @endif">
                {{--<div class="col-md-6">
                    <div class="card-block">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <h5 class="text-bold card-title">Branch</h5>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <button class="btn btn-info" id="addBranch" wire:click.prevent="addBranch">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <tbody>
                                    @foreach ($branchItems as $branchIndex => $branch)
                                        <tr>
                                            <td>
                                                <select class="form-select"
                                                    name="branchItems[{{ $branchIndex }}][branchId]"
                                                    wire:model="branchItems.{{ $branchIndex }}.branchId" required>
                                                    <option selected="" value="">Choose...</option>
                                                    @foreach ($branches as $branchOption)
                                                        <option value="{{ $branchOption->id }}">
                                                            {{ $branchOption->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </td>

                                            <td>
                                                <a class="btn btn-info delete-header m-1 btn-sm d-flex justify-content-center"
                                                    title="Delete Item"
                                                    wire:click="deleteBranch({{ $branchIndex }})">
                                                    <i aria-hidden="true" class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>--}}

                {{--<div class="col-md-6">
                    <div class="card-block">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <h5 class="text-bold card-title">Department</h5>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <button class="btn btn-info" id="addDepartment" wire:click.prevent="addDepartment">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <tbody>
                                    @foreach ($departmentItems as $departmentIndex => $department)
                                        <tr>
                                            <td>
                                                <select class="form-select"
                                                    name="departmentItems[{{ $departmentIndex }}][departmentId]"
                                                    wire:model="departmentItems.{{ $departmentIndex }}.departmentId" required>
                                                    <option selected="" value="">Choose...</option>
                                                    @foreach ($departments as $departmentOption)
                                                        <option value="{{ $departmentOption->id }}">
                                                            {{ $departmentOption->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </td>

                                            <td>
                                                <a class="btn btn-info delete-header m-1 btn-sm d-flex justify-content-center"
                                                    title="Delete Item"
                                                    wire:click="deleteDepartment({{ $departmentIndex }})">
                                                    <i aria-hidden="true" class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
