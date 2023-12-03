<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            //RoleAndPermissionSeeder::class,
            UserSeeder::class,
            //StatusSeeder::class,
            // SpecializationSeeder::class,
            // GenderSeeder::class,
            // DepartmentSeeder::class,
            // CivilStatusSeeder::class,
            // BloodTypeSeeder::class,
            // DiscountSeeder::class,
            // ModeOfPaymentSeeder::class,
            // BranchSeeder::class,
            // ConclusionSeeder::class,
            // CovidVaccinationSeeder::class,
            // FindingSeeder::class,
            // NatureOfExaminationSeeder::class,
            // UnitSeeder::class,
            // HydrationSeeder::class
        ]);
    }
}
