<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Guest',
            'last_name' => 'User',
        ]);

        User::create([
            'first_name' => 'Payam',
            'last_name' => 'Yasaie',
            'email' => 'payam@yasaie.ir',
            'password' => '123456',
            'mobile' => '09144799840',
            'company' => 'Tahlilgaran'
        ]);
    }
}
