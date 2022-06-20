<?php

namespace Database\Seeders;

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
        //Creal producto 1
        DB::table('products')->insert([
            'name' => 'Producto 1',
            'price' => 123.45,
            'tax' => 5,
        ]);
        //Creal producto 2
        DB::table('products')->insert([
            'name' => 'Producto 2',
            'price' => 145.65,
            'tax' => 15,
        ]);
        //Creal producto 3
        DB::table('products')->insert([
            'name' => 'Producto 3',
            'price' => 39.73,
            'tax' => 12,
        ]);
        //Creal producto 4
        DB::table('products')->insert([
            'name' => 'Producto 4',
            'price' => 250,
            'tax' => 8,
        ]);
        //Creal producto 5
        DB::table('products')->insert([
            'name' => 'Producto 5',
            'price' => 59.35,
            'tax' => 10,
        ]);
    }
}
