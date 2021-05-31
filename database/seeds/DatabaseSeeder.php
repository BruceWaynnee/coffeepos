<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // category, type, size
            CategoryTableSeeder::class,
            TypeTableSeeder::class,
            SizeTableSeeder::class,
            
            // product, product_variants, 
            ProductTableSeeder::class,
            ProductVariantTableSeeder::class,

        ]);
    }
}