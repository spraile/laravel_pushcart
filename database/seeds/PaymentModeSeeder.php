<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_modes')->insert ([
        	'name' => 'Cash on delivery'
        ]);
        DB::table('payment_modes')->insert ([
        	'name' => 'Paypal'
        ]);
    }
}
