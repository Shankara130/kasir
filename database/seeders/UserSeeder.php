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
        $userData = [
            [
                'name'     => 'Admin',
                'email'    => 'admin@gmail.com',
                'role'     => 'admin',
                'password' => Hash::make('admin')
            ],
            [
                'name'     => 'Kasir',
                'email'    => 'kasir@gmail.com',
                'role'     => 'kasir',
                'password' => Hash::make('kasir')
            ],
        ];

        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
