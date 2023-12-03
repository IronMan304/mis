<?php

namespace App\Http\Livewire\Customer;

use App\Imports\PatientImport;
use App\Models\Customer;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class CustomerList extends Component
{
    use WithPagination, WithFileUploads;

    public $customerId, $excel_file;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $numSkipped;


  

    protected $listeners = [
        'refreshParentCustomer' => '$refresh',
        //'refreshParentCustomerAccount' => '$refresh',
        'deleteCustomer',
        'editCustomer',
        'deleteConfirmCustomer',
    ];
    public $showButton = true; // Initialize showButton to true in your PatientList component

    public function updateShowButton($showButton)
    {
        $this->showButton = $showButton; // Update the local showButton property
    }

    public function mount($num_skipped = null)
    {
        $this->numSkipped = $num_skipped;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function createCustomerAccount($customerId)
    {

        $this->customerId = $customerId;
        $this->emit('resetInputFields');
        $this->emit('customerId', $this->customerId);
        $this->emit('openCustomerAccountModal');
    }

    public function createCustomer()
    {
        $this->emit('resetInputFields');
        $this->emit('openCustomerModal');
      
    }

    public function editCustomer($customerId)
    {
        $this->customerId = $customerId;
        $this->emit('customerId', $this->customerId);
        $this->emit('openCustomerModal');
     
    }
   
    // public function detailCustomer($customerId)
    // {
    //     $this->customerId = $customerId;
    //     return redirect()->to('/customer-detail');
    // }

    public function deleteConfirmCustomer($customerId)
    {
        $this->dispatchBrowserEvent('confirmCustomerDelete', [
            'title' => 'Are you sure?',
            'text' => "You won't be able to revert this!",
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'Yes, delete it!',
            'id' => $customerId
        ]);
    }

    public function deleteCustomer($customerId)
    {
        Customer::destroy($customerId);


        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $customers = Customer::paginate(10);
        } else {
            $customers = Customer::where('name', 'LIKE', '%' . $this->search . '%')->paginate(10);
        }

        return view('livewire.customer.customer-list', [
            'customers' => $customers
        ]);
    }

    // public function updated($propertyExcelFile)
    // {
    //     $this->validateOnly($propertyExcelFile, [
    //         'excel_file' => 'required|mimes:xlsx,xlsm,xlsb,xltx,xls,xlt,xls,xml,xml,xlam,xla,xla,xlw,xlr,prn,txt,csv,dif,slk,rtf', // 1MB Max
    //     ]);
    // }

    // public function fileImport()
    // {
    //     $path = $this->excel_file->getRealPath();
    //     $import = new PatientImport(0);
    //     Excel::import($import, $path);
    //     $skipNumber = $this->numSkipped = $import->num_skipped;

    //     $this->emit('refreshParentPatient');

    //     if ($skipNumber > 0) {
    //         $action = 'warning';
    //         $message = 'Skipped ' . $skipNumber . ' record(s) because they already exist in the database.';
    //         $this->emit('showEmittedFlashMessage', $action, $message);
    //         $this->emit('flashAction', $action, $message);
    //     } else {
    //         $action = 'store';
    //         $message = 'Records successfully stored in the database';
    //         $this->emit('showEmittedFlashMessage', $action, $message);
    //         $this->emit('flashAction', $action, $message);
    //     }

    //     // Reset the file input field
    //     $this->excel_file = null;


    //     $this->reset();
    //     $this->resetPage();

    //     $this->emit('refreshParentPatient');
    //     $this->emit('refreshTable');
    // }
}
