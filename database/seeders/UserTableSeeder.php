<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'uuid' => (string) Str::uuid(),
            'name' => 'Zembi',
            'email' => 'zembi@hr.com',
            'password' => 'password',
        ];

        User::firstOrCreate($user);
    }
}
