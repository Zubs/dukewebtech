<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => Str::uuid(),
            'name' => 'Admin Admin',
            'email' => 'test@test.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);
    }
}
