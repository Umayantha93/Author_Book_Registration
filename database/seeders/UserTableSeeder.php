<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => "Umayantha",
            'email' => 'umayantha@gmail.com',
            'password' => bcrypt('umayantha1234'),
            'status' => true,
            'is_admin' => true,
            ]);
    }
}
