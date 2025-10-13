<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'superadmin@strengthlink.org'],
            [
                'name'      => 'Tshepi',
                'password'  => Hash::make('Admin@12345'),
                'is_super'  => true,
            ]
        );

        Admin::updateOrCreate(
            ['email' => 'admin@strengthlink.org'],
            [
                'name'      => 'Moeng',
                'password'  => Hash::make('Admin@12345'),
                'is_super'  => false,
            ]
        );
    }
}
