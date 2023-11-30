<x-app-layout>
  <div class="content">
    @if(!auth()->user()->hasRole('Patient'))
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
            <li class="breadcrumb-item"><a href="/patient">Patient list</a></li>
            <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
            <li class="breadcrumb-item">Patient Booking History List</li>
          </ul>
        </div>
      </div>
    </div>
    @endif
    @include('layouts.shared.flash')
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="about-info">
                  {{--<h2 class="bold">Patients Profile</h2>--}}
                </div>
                <div class="doctor-profile-head">

                  <div class="row">
                    <div class="col-lg-6 col-xl-4 col-md-4">
                      <div class="profile-user-box">
                        <div class="profile-user-img">
                          <img src="{{asset('assets/img/profile-user-01.jpg')}}" alt="Profile">
                          <div class="form-group doctor-up-files profile-edit-icon mb-0">
                            <div class="uplod d-flex">
                              <label class="file-upload profile-upbtn mb-0">
                                <img src="{{asset('assets/img/icons/camera-icon.svg')}}" alt="Profile"></i><input type="file">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="names-profiles">
                          <h4>{{ $patient->name }}</h4>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 d-flex align-items-center">
                      <div class="follow-group">



                      </div>
                    </div>
                    <div class="col-lg-6 col-xl-4 d-flex align-items-center">

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="doctor-personals-grp">
              <div class="card">
                <div class="card-header">
                  <div class="heading-detail ">
                    <h3 class="mb-0">About me
                      <button type="button" class="btn btn-primary btn-sm mx-1" wire:click="editPatient({{ $patient->id }})" title="Edit" id="open-edit-button">
                        <i class='fa fa-pen-to-square'></i>
                      </button>
                      <a class="btn btn-secondary" href="{{ route('patient.edit', $patient->id) }}"
																				title="Edit Information">
																				<i class="fa-solid fa-file-waveform"></i>
																			</a>
                    </h3>
                  </div>
                </div>

                <div class="card-body">

                  <div class="about-me-list">
                    <ul class="list-space">
                      <li>
                        <h4>Name</h4>
                        <span>{{ $patient->name }}</span>
                      </li>
                      <li>
                        <h4>Address</h4>
                        <span>{{ $patient->address }}</span>
                      </li>
                      <li>
                        <h4>Contact Number</h4>
                        <span>{{ $patient->contact_number }}</span>
                      </li>
                      <li>
                        <h4>Gender</h4>
                        <span>{{ $patient->genders->name ?? ''}}</span>
                      </li>
                      <li>
                        <h4>Age</h4>
                        <span>{{ $patient->age }}</span>
                      </li>
                      <li>
                        <h4>Civil Status</h4>
                        <span style="{{ $civilStatuses ? '' : 'color: red;' }}">{{ $civilStatuses ?? 'Empty' }}</span>
                      </li>
                      <li>
                        <h4>Blood Type</h4>
                        <span style="{{ $bloodtypes ? '' : 'color: red' }}">{{ $bloodtypes ?? 'Empty' }}</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>


            <div class="doctor-personals-grp">
              <div class="card">
                <div class="card-body">
                  <div class="heading-detail">
                    <h4>Signature:</h4>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="doctor-personals-grp">
              @foreach($bookings as $booking)
              <div class="card">
                <div class="card-header">
                  <h3 class="mb-0">Booking
                    {{--<button type="button" class="btn btn-primary btn-sm mx-1" wire:click="editPatient({{ $patient->id }})" title="Edit" id="open-edit-button">
                    <i class='fa fa-pen-to-square'></i>
                    </button>
                    <button type="button" class="btn btn-primary btn-sm mx-1" wire:click="editPatient({{ $patient->id }})" title="Edit" id="open-edit-button">
                      <i class='fa fa-pen-to-square'></i>
                    </button>--}}
                    <a class="btn btn-secondary" href="{{ route('mobile_service.index', $booking->id) }}" title="View Booking">
                      <i class="fa-solid fa-eye"></i>
                    </a>

                  </h3>
                </div>
                <div class="card-body">
                  <div class="personal-list-out">
                    <div class="row">

                      <div class="col-xl-3 col-md-6">
                        <div class="detail-personal">
                          <h2>Booking ID</h2>
                          <h3>{{ $booking->id }}</h3>
                        </div>
                      </div>
                      <div class="col-xl-3 col-md-6">
                        <div class="detail-personal">
                          <h2>Mobile </h2>
                          <h3>{{ $booking->barcode }}</h3>
                        </div>
                      </div>
                      <div class="col-xl-3 col-md-6">
                        <div class="detail-personal">
                          <h2>Status</h2>
                          @if ($booking->status->id === 1)
                          <h3 class="text-danger">{{ $booking->status->name }}</h3>
                          @else
                          <h3 class="text-success">{{ $booking->status->name }}</h3>
                          @endif
                        </div>
                      </div>
                      <div class="col-xl-3 col-md-6">
                        <div class="detail-personal">
                          <h2>Total price</h2>
                          <h3>{{ $booking->total_price }}</h3>
                        </div>
                      </div>
                    </div>
                  </div>

                  <br>

                  <div class="personal-list-out">
                    <div class="row">
                      <div class="col-xl-3 col-md-6">
                        <div class="detail-personal">
                          <h2>Created At</h2>
                          <h3>{{ $booking->created_at }}</h3>
                        </div>
                      </div>
                      <div class="col-xl-3 col-md-6">
                        <div class="detail-personal">
                          <h2>Updated At</h2>
                          <h3>{{ $booking->updated_at }}</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach

              <div class="card">
                <div class="card-header">
                  <div class="heading-detail">
                    <h3 class="mb-0">Billing</h3>
                  </div>
                </div>
                <div class="card-body p-0 table-dash">
                  <div class="table-responsive">
                    <table class="table mb-0 border-0 datatable custom-table patient-profile-table">
                      <thead>
                        <tr>
                          <th>Total Amount</th>
                          <th>Payable Amount</th>
                          <th>Paid Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($billings as $billing)
                        <tr>
                          <td>{{ $billing->total_amt }}</td>
                          <td>{{ $billing->payable_amt }}</td>
                          <td>{{ $billing->paid_amt }}</td>
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
      </div>
    </div>
  </div>
  {{-- Modal --}}
<div wire.ignore.self class="modal fade" id="patientModal" tabindex="-1" role="dialog" aria-labelledby="patientModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered ">
        <livewire:patient.patient-form />
    </div>
</div>
@section('custom_script')
@include('layouts.scripts.patient-scripts')
@endsection
</x-app-layout>