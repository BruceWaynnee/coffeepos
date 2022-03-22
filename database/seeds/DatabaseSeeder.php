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
            // user, role, permission 
            UserTableSeeder::class,
            RoleTableSeeder::class,
            PermissionTableSeeder::class,

            // category, type, size
            CategoryTableSeeder::class,
            TypeTableSeeder::class,
            SizeTableSeeder::class,
            // sizeCsvRecordSeeder::class, // this is for database seeder import from csv
            
            // product, product_variants, 
            ProductTableSeeder::class,
            ProductVariantTableSeeder::class,

            // customers,
            CustomerTableSeeder::class,

        ]);
    }
}
