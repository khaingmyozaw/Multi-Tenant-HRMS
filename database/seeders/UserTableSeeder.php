<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'zembi@hr.com',
        ], [
            'uuid' => (string) Str::uuid(),
            'name' => 'Zembi',
            'username' => 'zembi',
            'password' => 'password',
        ]);
    }
}
