<div class="modal-content">

    <form wire:submit.prevent="store" enctype="multipart/form-data">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Add User Account </h4>

            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <h5> {{$name}}</h5>
            <div class="row mb-3">
                <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="first_name" class="form-control">
                </div>
                @error('first_name') <!-- Display validation error if it exists -->
                <p class="text-orange-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="middle_name" class="col-sm-2 col-form-label">Middle Name</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="middle_name" class="form-control">
                </div>
                @error('middle_name')
                <p class="text-orange-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="last_name" class="form-control">
                </div>
                @error('last_name')
                <p class="text-orange-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" wire:model="username" class="form-control">
                </div>
                @error('username')
                <p class="text-orange-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" wire:model="email" class="form-control">
                </div>
                @error('email')
                <p class="text-orange-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if (!isset($userId))
            <!-- This section will only be displayed if $userId is not set -->
            <div class="row mb-3">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" wire:model="password" class="form-control">
                </div>
                @error('password')
                <p class="text-orange-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            @endif
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <div class="form-group">
                <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>
        </div>
    </form>
</div>