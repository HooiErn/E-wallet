<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name'      => 'Admin',
            'username'  => 'admin',
            'email'     => 'admin@example.com',
            'password'  => bcrypt('password'),
            'handphone_number' => '011-12340912',
            'created_by'=> 'Auto',
        ]);

        User::factory()->create([
            'name'      => 'John Doe',
            'username'  => 'johndoe',
            'account_id'=> '100001',
            'email'     => 'john@example.com',
            'password'  => bcrypt('password'),
            'ic'        => '001023-01-2347',
            'handphone_number' => '011-12340912',
            'base_currency' => 'MYR',
            'balance' => '200.00',
            'credit_limit' => '2000.00',
            'join_date' => $this->faker->name(),
            'created_by'=> 'Admin',
        ]);
    }
}