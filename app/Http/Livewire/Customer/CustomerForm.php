<?php

namespace App\Http\Livewire\Customer;

use Carbon\Carbon;
use App\Models\Gender;
use App\Models\Booking;
use App\Models\Customer;
use Livewire\Component;
// use App\Models\BloodType;
// use App\Models\CivilStatus;

use App\Models\PatientCpeKey;
use App\Models\PatientSignature;

use Illuminate\Http\Request;


class CustomerForm extends Component
{
    public $customerId, $bookingId, $name, $first_name, $middle_name, $last_name;

    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'customerId',
        'resetInputFields',
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function customerId($customerId, $bookingId = null)
    {
        $this->customerId = $customerId;
        $this->bookingId = $bookingId;

        // Load the patient data and signature
        $patient = Customer::whereId($customerId)->first();
        $this->first_name = $patient->first_name;
        $this->middle_name = $patient->middle_name;
        $this->last_name = $patient->last_name;
        // $this->address = $patient->address;
        // $this->contact_number = $patient->contact_number;
        // $this->gender_id = $patient->gender_id;
        // $this->birthdate = $patient->birthdate;
        // $this->civil_status_id = $patient->civil_status_id;
        // $this->blood_type_id = $patient->blood_type_id;
    }


    //store
    public function store()
    {
        $data = $this->validate([
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            // 'address' => 'required',
            // 'contact_number' => 'required',
            // 'gender_id' => 'required',
            // 'birthdate' => 'nullable',
            // 'civil_status_id' => 'nullable',
            // 'blood_type_id' => 'nullable'
        ]);

        // $bday = Carbon::parse($this->birthdate);
        // $today = Carbon::now();
        // $dif = $bday->diff($today);
        // $data['age'] = $dif->y;
        // $data['name'] = $this->first_name . ', ' . $this->middle_name . ' ' . $this->last_name;

        if ($this->customerId) {
            $customer = Customer::find($this->customerId);
            $customer->update($data);

            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            $customer = Customer::create($data);

            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeCustomerModal');
        $this->emit('refreshParentCustomer');

        $this->emit('refreshTable');
    }

    public function render()
    {
        // $genders = Gender::all();
        // $bloodTypes = BloodType::all();
        // $civilStatuses = CivilStatus::all();

        return view('livewire.customer.customer-form');
    }
}
