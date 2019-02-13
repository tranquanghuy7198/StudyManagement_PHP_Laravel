<?php

use Illuminate\Database\Seeder;
use Hash;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 256,
            'password' => Hash::make(256),
            'who' => 3
        ]);
    }
}
