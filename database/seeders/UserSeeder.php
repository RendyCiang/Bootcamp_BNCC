<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), 
            'phone' => '081234567891',
            'admin_id' => 'Catalog123' ,
            'role' => 'admin', 
        ]);

        User::create([
            'name' => 'User Normal',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'), 
            'phone' => '081234567892',
            'role' => 'user', 
        ]);
    }
}
