<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0; $i < 10; $i++) { 
            # code...
      
        Product::create([
        	'name' => 'Machine A laver' .+ $i,
        	'slug' => 'machine-a-laver'.+ $i,
        	'details' => 'Haier machine a laver',
        	'price' => 140499,
          'last_price' => 999999,
        	'description' => 'lorem ipsumlorem ipsum lorem ipsum lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsum ',
        	'category' => 'test',
        	'stock' => 12.+$i,
        	'image' => '../storage/products/dummy/appliance-large.jpg',
        	'email' => 'caviaros123@gmail.com'
         ])->categories()->attach(1);
      }

      for ($i=0; $i < 10; $i++) { 
          # code...
    
        Product::create([
            'name' => 'Samsung Galaxy S' .+ $i,
            'slug' => 'samsung-s'.+ $i,
            'details' => '15 inch, 16Gb, 4GB RAM, 4 cores',
            'price' => 240099,
            'last_price' => 999999,
            'description' => 'lorem ipsumlorem ipsum lorem ipsum lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsum ',
            'category' => 'test',
            'stock' => 12.+$i,
            'image' => '../storage/products/dummy/phone-large.jpg',
            'email' => 'caviaros123@gmail.com'


            ])->categories()->attach(3);
         }

         for ($i=0; $i < 10; $i++) { 
          # code...
    
        Product::create([
            'name' => 'Ordinateur De Bureau' .+ $i,
            'slug' => 'ordinateur-de-bureau'.+ $i,
            'details' => '15 inch, 1TB SSD, 32GB RAM',
            'price' => 120000,
            'last_price' => 999999,
            'description' => 'lorem ipsumlorem ipsum lorem ipsum lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsum ',
            'category' => 'test',
            'stock' => 12.+$i,
            'image' => '../storage/products/dummy/desktop-large.jpg',
            'email' => 'caviaros123@gmail.com'


            ])->categories()->attach(2);
         }

         for ($i=0; $i < 10; $i++) { 
          # code...
    
          Product::create([
            'name' => 'Canon EOS' .+ $i,
            'slug' => 'canon-eos'.+ $i,
            'details' => 'Objectifs 55mm f1/8',
            'price' => 300099,
            'last_price' => 999999,
            'description' => 'lorem ipsumlorem ipsum lorem ipsum lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsum ',
            'category' => 'test',
            'stock' => 12.+$i,
            'image' => '../storage/products/dummy/camera-large.jpg',
            'email' => 'caviaros123@gmail.com'


            ])->categories()->attach(5);
         }

         for ($i=0; $i < 10; $i++) { 
          # code...
    
          Product::create([
            'name' => 'Tv plasma' .+ $i,
            'slug' => 'tv-plasma'.+ $i,
            'details' => '15 inch, Oled TV 3D',
            'price' => 300099,
            'last_price' => 999999,
            'description' => 'lorem ipsumlorem ipsum lorem ipsum lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsum ',
            'category' => 'test',
            'stock' => 12.+$i,
            'image' => '../storage/products/dummy/tv-large.jpg',
            'email' => 'caviaros123@gmail.com'


            ])->categories()->attach(6);
         }
    }
}
