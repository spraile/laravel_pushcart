<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert ([
        	'name' => 'Pending'
        ]);
        DB::table('statuses')->insert ([
        	'name' => 'Completed'
        ]);
        DB::table('statuses')->insert ([
        	'name' => 'Cancelled'
        ]);
    }
}
