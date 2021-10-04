<?php

namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Admin::create([
            'username'      => 'admin',
            'password'      => Hash::make('123456'),
            'fullname'      => 'Super Admin',
        ]);
    }
}
