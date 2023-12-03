<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::insert([
            ['name' => 'Pending'],
            ['name' => 'Approved'], // maybe registered
            ['name' => 'Cancelled'],
            ['name' => 'Processing'],
            ['name' => 'Paid'],
            ['name' => 'Unpaid'],
            ['name' => 'Active'], //started
            ['name' => 'Inactive'], //ended
            ['name' => 'Billed'],
            ['name' => 'Temporary'],
            ['name' => 'Permanent'],
            ['name' => 'Accepted'],
            ['name' => 'Collected'],
            ['name' => 'In use'],
            ['name' => 'Good'],
            ['name' => 'Bad'],
        ]);
    }
}
