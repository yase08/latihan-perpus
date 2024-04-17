<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@localhost',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'username' => 'user',
            'email' => 'user@localhost',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'username' => 'staff',
            'email' => 'staff@localhost',
            'password' => bcrypt('password'),
        ]);

        $admin = User::where('email', 'admin@localhost')->first();
        $admin->assignRole('admin');

        $user = User::where('email', 'user@localhost')->first();
        $user->assignRole('borrower');

        $staff = User::where('email', 'staff@localhost')->first();
        $staff->assignRole('staff');
    }
}
