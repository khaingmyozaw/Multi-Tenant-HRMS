<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Company;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()
            // ->has(Department::factory(3))
            ->hasDepartments(3)
            ->hasPositions(6)
            ->has(
                User::factory()
                    ->count(10)
                    ->has(Attendance::factory()->count(30))
            )
            ->count(10)
            ->create();
    }
}
