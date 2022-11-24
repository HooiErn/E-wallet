<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;


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
            'account_name' => 'admin',
            'account_level' => '1',
            'account_id' => '000000000000',
            'created_by'=> 'Auto',
            'join_date' => Carbon::today(),
            'credit_limit' => 10000,
            'credit_available' => 200,
        ]);

     
    }
}