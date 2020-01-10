<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       DB::table('users')->insert ([
        'name' => 'admin',
        'email' => 'admin@email.com',
        'password' => Hash::make('123123123'),
        'role_id' => 1
       ]);
      
       DB::table('users')->insert ([
        'name' => 'Alice',
        'email' => 'alice@email.com',
        'password' => Hash::make('123123123'),
        'role_id' => 2
       ]);
       
       DB::table('users')->insert ([
        'name' => 'Eugeo',
        'email' => 'eugeo@email.com',
        'password' => Hash::make('123123123'),
        'role_id' => 2
       ]);

       DB::table('users')->insert ([
       	'name' => 'Kirito',
       	'email' => 'kirito@email.com',
       	'password' => Hash::make('123123123'),
        'role_id' => 2
       ]);

    }
}
