<?php

use Illuminate\Database\Seeder;

class admins extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'id' => 256,
            'fullName' => 'Nguyễn Thái Khoa',
            'who' => 3
        ]);
    }
}
