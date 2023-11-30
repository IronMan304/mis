<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission::create(['name' => 'create-users']);
        // Permission::create(['name' => 'edit-users']);
        // Permission::create(['name' => 'delete-users']);

        // Permission::create(['name' => 'create-system-config']);
        // Permission::create(['name' => 'edit-system-config']);
        // Permission::create(['name' => 'delete-system-config']);

        // Permission::create(['name' => 'create-appointments']);
        // Permission::create(['name' => 'edit-appointments']);
        // Permission::create(['name' => 'delete-appointments']);
        
        // Permission::create(['name' => 'create-services']);
        // Permission::create(['name' => 'edit-services']);
        // Permission::create(['name' => 'delete-services']);
        
        // Permission::create(['name' => 'create-booking']);
        // Permission::create(['name' => 'edit-booking']);
        // Permission::create(['name' => 'delete-booking']);
        
        // Permission::create(['name' => 'create-assignment']);
        // Permission::create(['name' => 'edit-assignment']);
        // Permission::create(['name' => 'delete-assignment']);
        
        // Permission::create(['name' => 'create-reports']);
        // Permission::create(['name' => 'edit-reports']);
        // Permission::create(['name' => 'delete-reports']);

        // Permission::create(['name'=> 'view-patient-bookings']);

        $adminRole = Role::create(['name' => 'admin']);
        $customerRole = Role::create(['name' => 'customer']);
        // $doctorRole = Role::create(['name' => 'doctor']);
        // $staffRole = Role::create(['name' => 'staff']);
        // $supervisorRole = Role::create(['name' => 'supervisor']);
        // $encoderRole = Role::create(['name' => 'encoder']);
        // $patientRole = Role::create(['name' => 'patient']);

        // $adminRole->givePermissionTo([
        //     'create-users',
        //     'edit-users',
        //     'delete-users',
        //     'create-system-config',
        //     'edit-system-config',
        //     'delete-system-config',
        //     'create-appointments',
        //     'edit-appointments',
        //     'delete-appointments',
        //     'create-services',
        //     'edit-services',
        //     'delete-services',
        //     'create-booking',
        //     'edit-booking',
        //     'delete-booking',
        //     'create-assignment',
        //     'edit-assignment',
        //     'delete-assignment',
        //     'create-reports',
        //     'edit-reports',
        //     'delete-reports'
        // ]);

        // $customerRole->givePermissionTo([
          
        // ]);

        // $doctorRole->givePermissionTo([
        //     'create-users',
        //     'edit-users',
        //     'create-appointments',
        //     'edit-appointments',
        //     'delete-appointments'
        // ]);

        // $staffRole->givePermissionTo([
        //     'edit-system-config',
        //     'create-appointments',
        //     'edit-appointments',
        //     'delete-appointments',
        //     'create-booking',
        //     'edit-booking',
        //     'delete-booking',
        // ]);

        // $supervisorRole->givePermissionTo([
        //     'create-assignment',
        //     'edit-assignment',
        //     'delete-assignment',
        //     'create-reports',
        //     'edit-reports',
        //     'delete-reports'
        // ]);

        // $encoderRole->givePermissionTo([
        //     'edit-assignment'
        // ]);

        // $patientRole->givePermissionTo([
        //     'view-patient-bookings'
        // ]);
    }
}
