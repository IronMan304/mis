<?php

namespace App\Http\Livewire\Customer;

use App\Models\User;
use App\Models\Customer;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class CustomerAccountForm extends Component
{

    public $name, $user_id, $customerId, $last_name, $first_name, $middle_name, $username, $email, $password;
    public $action = '';  //flash
    public $message = '';  //flash
    public $showButton = true;

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
    // public function customerId($customerId)
    // {
    //     $this->customerId   = $customerId;
    //     $create = Patient::find($customerId);
    //     $this->name           = $create->name;
    // }

    public function customerId($customerId)
    {
        $this->customerId = $customerId;
        $customer = Customer::whereId($customerId)->first();
        $this->first_name = $customer->first_name;
        $this->middle_name = $customer->middle_name;
        $this->last_name = $customer->last_name;
        $this->username = strtolower($this->first_name . $this->last_name);
        $this->username = str_replace(' ', '', $this->username);
        $this->email = strtolower($this->first_name . $this->last_name . "@gmail.com");
        $this->email = str_replace(' ', '', $this->email);
        $this->password = Str::random(8); // Generate a random passcode of length 8
    }

    //store
    public function store()
    {
        $data = $this->validate([

            'last_name' => 'required',
            'first_name' =>  'required',
            'middle_name' =>  'nullable',
            'username' =>  'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6']
        ]);

        // Concatenate and convert to lowercase
        $user = User::create([
            'id' => $this->user_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);



        // Assign the "patient" role to the user
        $user->assignRole('customer');

        $customer = Customer::find($this->customerId);

        // Update the user_id field in the customer model
        $customer->user_id = $user->id; // Set the user_id to the ID of the newly created user
        $customer->save(); // Save the changes to the patient record



        $action = 'store';
        $message = 'Successfully Created';
        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeCustomerAccountModal');
        $this->emit('refreshParentCustomerAccount');
        $this->emit('refreshTable');
        //$this->reset();
    }

    public function render()
    {
        $customerId = $this->customerId;
        return view('livewire.customer.customer-account-form', [
            'customerId' => $customerId,
        ]);
    }
}
