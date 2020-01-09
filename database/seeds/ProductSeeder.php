<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert ([
        	'name' => 'Borgar',
        	'price' => '55.00',
        	'description' => 'Borgar',
        	'category_id' => 1,
        	'image' => 'products/a2fjRBQBMu316e0hmTyev2bGLXpCBDS9vIB9bGTQ.jpeg'

        ]);
        DB::table('products')->insert ([
        	'name' => 'Shades',
        	'price' => '88.00',
        	'description' => 'Shade of doom',
        	'category_id' => 2,
        	'image' => 'products/rX1AbdjbvI40BmmH4Cpvz4C21Is1tDOqhtPFAqKo.jpeg'

        ]);
        DB::table('products')->insert ([
        	'name' => 'Drone',
        	'price' => '5655.00',
        	'description' => 'Flying drone',
        	'category_id' => 3,
        	'image' => 'products/vGKsLdNXARGWlP3cR9nKcQLzPshKqPL5gWTkvcl4.jpeg'

        ]);
    }
}
