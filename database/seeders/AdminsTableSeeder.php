<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory()->create([
            'name' => 'Admin',
            'password' => sha1('password'),
            'username' => 'admin',
            'email' => 'admin@example.com',
        ]);
    }
}