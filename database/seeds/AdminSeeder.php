<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email'         => 'admin@gmail.com',
            'username'      => 'admin',
            'password'      => 'admin',
            'first_name'    => 'admin',
            'last_name'     => 'admin',
            'user_type'     => 2
        ]);
    }
}
