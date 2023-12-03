<div class="content">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item">Tool List</li>
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
                                    <h3>Tool List</h3>
                                    <div class="doctor-search-blk">
                                        <div class="add-group">
                                            <a wire:click="createTool" class="btn btn-primary ms-2" id="open-form-button"><img src="{{ asset('assets/img/icons/plus.svg') }}" alt></a>
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
                </div>

                <div class="table-responsive">
                    <table class="table border-0 custom-table comman-table datatable mb-0">
                        <thead>
                            <tr>
                                <th style="width: 30%">Name</th>
                                <!-- <th style="width: 30%">Condition</th> -->
                                <th style="width: 30%">Quantity</th>
                                <th>Action</th>
                                {{--<th style="width: 15%">Department</th>
                                <th style="width: 30%">Description</th>
                                <th style="width: 25%">Price</th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tools as $tool)
                                <tr>
                                    <td>
                                        {{ $tool->name }}
                                    </td>
                                    <!-- <td>
                                        {{ $tool->status->name ?? '' }}
                                    </td> -->
                                    <td>
                                        {{ $tool->quantity ?? '' }}
                                    </td>
                                    {{--<td>
                                        {{ $tool->department->name }}
                                    </td>
                                    <td>
                                        {{ $tool->description }}
                                    </td>
                                    <td class="text-end">
                                        {{ number_format($tool->price, 2) }}
                                    </td>--}}
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btn-sm mx-1"
                                                wire:click="editTool({{ $tool->id }})" title="Edit">
                                                <i class='fa fa-pen-to-square'></i>
                                            </button>
                                            {{--<button type="button" class="btn btn-info btn-sm mx-1"
                                                wire:click="setResult({{ $tool->id }})" title="Setup Result">
                                                <i class="fa-solid fa-list-check"></i>
                                            </button>--}}
                                            {{-- <a class="btn btn-danger btn-sm mx-1" wire:click="deleteService({{ $service->id }})" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a> --}}
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

{{-- Modal --}}
<div wire.ignore.self class="modal fade" id="toolModal" tabindex="-1" role="dialog" aria-labelledby="toolModal"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <livewire:tool.tool-form />
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.tool-scripts')
@endsection
