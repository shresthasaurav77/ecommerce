<?php

use Illuminate\Database\Seeder;

class productsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
        	
        	 'product_name' => Str::random(40),
        	  'product_code' => Str::random(10),
        	   'product_color' => Str::random(10),
        	   'decription' =>Str::random(50),
        	   'price' =>Str::random(20),
        	   'care'=>Str::random(30),
        ]); 
    }
}
