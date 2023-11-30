<?php

namespace App\Http\Livewire\User;

use App\Models\User;
// use App\Models\Branch;
// use App\Models\Department;
use Livewire\Component;

class UserList extends Component
{
    public $userId;
    public $search = '';
    public $branchFilter = ''; // Add branchFilter property
    public $departmentFilter = ''; // Add departmentFilter property
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentUser' => '$refresh',
        'deleteUser',
        'editUser',
        'deleteConfirmUser'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createUser()
    {
        $this->emit('resetInputFields');
        $this->emit('openUserModal');
    }

    public function editUser($userId)
    {
        $this->userId = $userId;
        $this->emit('userId', $this->userId);
        $this->emit('openUserModal');
    }

    public function deleteUser($userId)
    {
        User::destroy($userId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    // public function render()
    // {
    //     $usersQuery = [];
    //     $branches = Branch::all();
    //     $departments = Department::all();

    //     if (!empty($this->search)) {
    //         $usersQuery = User::where(function ($query) {
    //             $query->where('first_name', 'LIKE', '%' . $this->search . '%')
    //                 ->orWhere('last_name', 'LIKE', '%' . $this->search . '%')
    //                 ->orWhere('username', 'LIKE', '%' . $this->search . '%')
    //                 ->orWhere('email', 'LIKE', '%' . $this->search . '%');
    //         });

    //         // Apply branch filter if selected
    //         if (!empty($this->branchFilter)) {
    //             $usersQuery->whereHas('branch_keyss', function ($query) {
    //                 $query->where('branch_id', $this->branchFilter);
    //             });
    //         }

    //         $users = $usersQuery->get();
    //     } elseif (!empty($this->branchFilter)) {
    //         // If only branch filter is selected
    //         $users = User::whereHas('branch_keyss', function ($query) {
    //             $query->where('branch_id', $this->branchFilter);
    //         })->get();
    //     } else {
    //         $users = User::all();
    //     }

    //     if (!empty($this->search)) {
    //         $usersQuery = User::where(function ($query) {
    //             $query->where('first_name', 'LIKE', '%' . $this->search . '%')
    //                 ->orWhere('last_name', 'LIKE', '%' . $this->search . '%')
    //                 ->orWhere('username', 'LIKE', '%' . $this->search . '%')
    //                 ->orWhere('email', 'LIKE', '%' . $this->search . '%');
    //         });

    //         // Apply department filter if selected
    //         if (!empty($this->departmentFilter)) {
    //             $usersQuery->whereHas('department_keyss', function ($query) {
    //                 $query->where('department_id', $this->departmentFilter);
    //             });
    //         }

    //         $users = $usersQuery->get();
    //     } elseif (!empty($this->departmentFilter)) {
    //         // If only department filter is selected
    //         $users = User::whereHas('department_keyss', function ($query) {
    //             $query->where('department_id', $this->departmentFilter);
    //         })->get();
    //     } else {
    //         $users = User::all();
    //     }

    //     return view('livewire.user.user-list', [
    //         'users' => $users,
    //         'branches' => $branches,
    //         'departments' => $departments
    //     ]);
    // }

    public function render()
{
    // $branches = Branch::all();
    // $departments = Department::all();

    $usersQuery = User::query();

    if (!empty($this->search)) {
        $usersQuery->where(function ($query) {
            $query->where('first_name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('username', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        });
    }

    if (!empty($this->branchFilter)) {
        $usersQuery->whereHas('branch_keyss', function ($query) {
            $query->where('branch_id', $this->branchFilter);
        });
    }

    if (!empty($this->departmentFilter)) {
        $usersQuery->whereHas('department_keyss', function ($query) {
            $query->where('department_id', $this->departmentFilter);
        });
    }

    $users = $usersQuery->get();

    return view('livewire.user.user-list', [
        'users' => $users,
        // 'branches' => $branches,
        // 'departments' => $departments
    ]);
}

}
