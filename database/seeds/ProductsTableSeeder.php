<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('products')->truncate();

      for($i = 0; $i<50; $i++){
        DB::table('products')->insert([
          'name' => str_random(10),
          'price' => rand(70000,200000),
          'image' => 'lon'. rand(1,8) .'.jpg',
          'description' => str_random(50),
          'discount' => rand(0,1)/10
        ]);
      }
    }
}
