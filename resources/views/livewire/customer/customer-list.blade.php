<div class="content">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Customer List</li>
                </ul>
            </div>
        </div>
    </div>
    <livewire:flash-message.flash-message />
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
            <div class="card card-table show-entire">
                <div class="card-body">

                    <div class="page-table-header mb-2">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="doctor-table-blk">
                                    <h3>Customer List</h3>
                                    <div class="doctor-search-blk">
                                        <div class="add-group">
                                            <a wire:click="createCustomer" class="btn btn-primary ms-2" id="open-form-button"><img src="{{ asset('assets/img/icons/plus.svg') }}" alt></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <div class="top-nav-search table-search-blk">
                                    <form>
                                        <input type="text" class="form-control" placeholder="Search here" wire:model.debounce.500ms="search" name="search">
                                        <a class="btn"><img src="{{ asset('assets/img/icons/search-normal.svg') }}" alt></a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{--<form wire:submit.prevent="fileImport" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="file" wire:model.defer="excel_file" class="form-control-file" required>

                                <div wire:loading wire:target="excel_file" class="text-dark">Uploading...</div>
                                @error('excel_file')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary hstack gap-2 align-self-center">
                                    <i class="demo-psi-add fs-5"></i>
                                    Import
                                </button>
                            </div>
                        </div>
                    </form>--}}

                    <div class="table-responsive">
                        <table class="table border-0 custom-table comman-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                <tr>
                                    <td>
                                        {{ $customer->first_name }}  {{ $customer->middle_name }}  {{ $customer->last_name }}
                                    </td>
                                  
                                    {{--<td>
                                        @if ($customer->gender_id == null)
                                        <span class="text-danger">Set customer
                                            gender</span>
                                        @else
                                        @if ($customer->gender_id == 1)
                                        <span class="badge" style="background: #00A9FF">{{ $customer->genders->name }}</span>
                                        @else
                                        <span class="badge" style="background: #F875AA">{{ $customer->genders->name }}</span>
                                        @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if ($customer->age == null)
                                        <span class="text-danger">Set customer
                                            birthdate</span>
                                        @else
                                        {{ Carbon\Carbon::parse($customer->birthdate)->format('M d, Y') }}
                                        (<i>{{ $customer->age }} years old</i>)
                                        @endif
                                    </td>--}}
                                    <td class="text-center">
                                        <div class="btn-group" role="group">

                                            {{--<a class="btn btn-primary btn mx-1" href="{{ route('pbh.index', $customer->id)}}" target="_blank" title="View Customer History">
												<i class="fa-solid fa-clipboard-list"></i>
											</a>--}}

                                            <button type="button" class="btn btn-primary btn-sm mx-1" wire:click="editCustomer({{ $customer->id }})" title="Edit" id="open-edit-button">
                                                <i class='fa fa-pen-to-square'></i>
                                            </button>
                                            {{-- <a class="btn btn-danger btn-sm mx-1"
                                                    wire:click="deletePatient({{ $patient->id }})" title="Delete">
                                            <i class="fa fa-trash"></i>
                                            </a> --}}
                                            @if($customer->user_id == null)
                                            <button type="button" class="btn btn-primary btn-sm mx-1" wire:click="createCustomerAccount({{ $customer->id }})" title="Add">

                                                <i class="fa-solid fa-user-plus"></i>
                                            </button>

                                            @endif


                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modal --}}
<div wire.ignore.self class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered ">
        <livewire:customer.customer-form />
    </div>
</div>
<div wire.ignore.self class="modal fade" id="customerAccountModal" tabindex="-1" role="dialog" aria-labelledby="customerAccountModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <livewire:customer.customer-account-form />
    </div>
</div>
@section('custom_script')
@include('layouts.scripts.customer-scripts')
@endsection

