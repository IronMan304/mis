<?php

namespace App\Http\Livewire\User;

// use App\Models\Branch;
// use App\Models\Doctor;
// use App\Models\Department;
use App\Models\User;
// use App\Models\UserBranchKey;
// use App\Models\UserDepartmentKey;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserForm extends Component
{
    public $userId, $first_name, $middle_name, $last_name, $username, $email, $password, $password_confirmation;
    public $action = '';  //flash
    public $message = '';  //flash
    public $roleCheck = array();
    public $selectedRoles = [];


    public $branchItems = [];
    public $departmentItems = [];


    protected $listeners = [
        'userId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    //edit
    public function userId($userId)
    {
        $this->userId = $userId;
        $user = User::find($userId);
        $this->first_name = $user->first_name;
        $this->middle_name = $user->middle_name;
        $this->last_name = $user->last_name;
        $this->username = $user->username;
        $this->email = $user->email;

        $this->selectedRoles = $user->getRoleNames()->toArray();

        // Load the selected branches for the user
        if ($user->branch_keyss != null) {
            $this->branchItems = collect($user->branch_keyss)->map(function ($branchKey) {
                return ['branchId' => $branchKey->branch_id];
            })->toArray();
        } else {
            // If no branches are associated with the user, initialize an empty array
            $this->branchItems = [];
        }

        // Load the selected departments for the user
        if ($user->department_keyss != null) {
            $this->departmentItems = collect($user->department_keyss)->map(function ($departmentKey) {
                return ['departmentId' => $departmentKey->department_id];
            })->toArray();
        } else {
            // If no departments are associated with the user, initialize an empty array
            $this->departmentItems = [];
        }
    }


    // public function doctorId($doctorId)
    // {
    //     $selectedDepartmentIds = array();
    //     $selectedSpecializationIds = array();
    //     $this->doctorId = $doctorId;
    //     $doctor = Doctor::find($doctorId);
    //     $this->first_name = $doctor->first_name;
    //     $this->middle_name = $doctor->middle_name;
    //     $this->last_name = $doctor->last_name;
    //     $this->license_num = $doctor->license_num;
    //     $this->tin_num = $doctor->tin_num;
    //     $this->ptr_num = $doctor->ptr_num;

    //     // Load the selected departments for the doctor
    //     if ($doctor->department_keys != null) {
    //         $selectedDepartmentIds = $doctor->department_keys->pluck('department_id')->toArray();
    //     }
    //     if ($doctor->specialization_keys != null) {
    //         $selectedSpecializationIds = $doctor->specialization_keys->pluck('specialization_id')->toArray();
    //     }

    //     // Populate the departmentItems array with selected department IDs
    //     $this->departmentItems = collect($selectedDepartmentIds)->map(function ($departmentId) {
    //         return ['departmentId' => $departmentId];
    //     })->toArray();
    //     $this->specializationItems = collect($selectedSpecializationIds)->map(function ($specializationId) {
    //         return ['specializationId' => $specializationId];
    //     })->toArray();
    // }

    //store
    public function store()
    {

        if (is_object($this->selectedRoles)) {
            $this->selectedRoles = json_decode(json_encode($this->selectedRoles), true);
        }

        if (empty($this->roleCheck)) {
            $this->roleCheck = array_map('strval', $this->selectedRoles);
        }

        $is_doc = false;
        foreach ($this->roleCheck as $role) {
            if ($role == 'doctor') {
                $is_doc = true;
            }
        }

        if ($this->userId) {

            $data = $this->validate([
                'first_name'    => 'required',
                'middle_name'   => 'nullable',
                'last_name'     => 'required',
                'username'      => 'required',
                'email'         => ['required', 'email'],
                
            ]);
            
            
            $user = User::find($this->userId);
            $user->update($data);

            // $doc = Doctor::where('user_id', $user->id)->first();
            // if ($is_doc == true) {
            //     if ($doc == null) {
            //         Doctor::create([
            //             'user_id'       => $user->id,
            //             'first_name'    => $this->first_name,
            //             'middle_name'   => $this->middle_name,
            //             'last_name'     => $this->last_name
            //         ]);
            //     } else {
            //         $doc->update([
            //             'first_name'    => $this->first_name,
            //             'middle_name'   => $this->middle_name,
            //             'last_name'     => $this->last_name
            //         ]);
            //     }
            // } else {
            //     if ($doc != null) {
            //         $doc->delete();
            //     }
            // }
            if (!empty($this->password)) {
                $this->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
    
                $user->update([
                    'password' => Hash::make($this->password),
                ]);
            }
            $user = User::find($this->userId);
            $user->update($data);

            // Update the doctor's assigned departments
            // $this->updateUserBranches($user);
            // $this->updateUserDepartments($user);
            // $this->updateDoctorSpecializations($user);

            $user->syncRoles($this->roleCheck);

            $action = 'edit';
            $message = 'Successfully Updated';
        } else {

            $this->validate([
                'first_name'    => 'required',
                'middle_name'   => 'nullable',
                'last_name'     => 'required',
                'username'      => 'required',
                'email'         => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'first_name'    => $this->first_name,
                'middle_name'   => $this->middle_name,
                'last_name'     => $this->last_name,
                'username'      => $this->username,
                'email'         => $this->email,
                'password'      => Hash::make($this->password)
            ]);

            $user->assignRole($this->roleCheck);

            // if ($is_doc == true) {
            //     Doctor::create([
            //         'user_id'       => $user->id,
            //         'first_name'    => $this->first_name,
            //         'middle_name'   => $this->middle_name,
            //         'last_name'     => $this->last_name
            //     ]);
            // }
            // $this->createUserBranches($user);
            // $this->createUserDepartments($user);

            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeUserModal');
        $this->emit('refreshParentUser');
        $this->emit('refreshTable');
    }

    // private function createUserBranches($user)
    // {
    //     foreach ($this->branchItems as $item) {
    //         $branchId = isset($item['branchId']) ? $item['branchId'] : null;
    //         UserBranchKey::create([
    //             'user_id' => $user->id,
    //             'branch_id' => $branchId,
    //         ]);
    //     }
    // }

    // private function createUserDepartments($user)
    // {
    //     foreach ($this->departmentItems as $item) {
    //         $departmentId = isset($item['departmentId']) ? $item['departmentId'] : null;
    //         UserDepartmentKey::create([
    //             'user_id' => $user->id,
    //             'department_id' => $departmentId,
    //         ]);
    //     }
    // }

    private function updateUserBranches($user)
    {
        $user->branch_keys()->delete(); // Remove existing relationships
        $this->createUserBranches($user); // Create new relationships
    }

    private function updateUserDepartments($user)
    {
        $user->department_keys()->delete(); // Remove existing relationships
        $this->createUserDepartments($user); // Create new relationships
    }


    public function addBranch()
    {
        $this->branchItems[] = [
            'branchId' => null
        ];
    }

    public function addDepartment()
    {
        $this->departmentItems[] = [
            'departmentId' => null
        ];
    }

    public function deleteBranch($branchIndex)
    {
        unset($this->branchItems[$branchIndex]);
        $this->branchItems = array_values($this->branchItems);
    }

    public function deleteDepartment($departmentIndex)
    {
        unset($this->departmentItems[$departmentIndex]);
        $this->departmentItems = array_values($this->departmentItems);
    }

    public function getBranchIds()
    {
        return array_map(function ($item) {
            return ['branch_id' => $item['branchId']];
        }, $this->branchItems);
    }

    public function getDepartmentIds()
    {
        return array_map(function ($item) {
            return ['department_id' => $item['departmentId']];
        }, $this->departmentItems);
    }

    public function render()
    {
        // $branches = Branch::all();
        // $departments = Department::all();
        $roles = Role::all();
        return view('livewire.user.user-form', [
            'roles' => $roles,
            // 'branches' => $branches,
            // 'departments' => $departments
        ]);
    }
}
