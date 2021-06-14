<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        /**
         * ========================================
         *      All Modules Permission Seeder 
         * ========================================
         */

            // Product Type Permissions Seeder [BEGIN]
                Permission::create(['name' => 'view product-type']);
                Permission::create(['name' => 'create product-type']);
                Permission::create(['name' => 'edit product-type']);
                Permission::create(['name' => 'delete product-type']);
            // Product Type Permissions Seeder [END]

            // Product Size Permissions Seeder [BEGIN]
                Permission::create(['name' => 'view product-size']);
                Permission::create(['name' => 'create product-size']);
                Permission::create(['name' => 'edit product-size']);
                Permission::create(['name' => 'delete product-size']);
            // Product Size Permissions Seeder [END]

            // Product Permissions Seeder [BEGIN]
                Permission::create(['name' => 'view product']);
                Permission::create(['name' => 'create product']);
                Permission::create(['name' => 'edit product']);
                Permission::create(['name' => 'delete product']);
            // Product Permissions Seeder [END]
            
            // Product Variant Permissions Seeder [BEGIN]
                Permission::create(['name' => 'view product-variant']);
                Permission::create(['name' => 'create product-variant']);
                Permission::create(['name' => 'edit product-variant']);
                Permission::create(['name' => 'delete product-variant']);
            // Product Variant Permissions Seeder [END]

            // Order Permissions Seeder [BEGIN]
                Permission::create(['name' => 'view order']);
                // Permission::create(['name' => 'create order']);
                // Permission::create(['name' => 'edit order']);
                Permission::create(['name' => 'delete order']);
            // Order Permissions Seeder [END]

            // Category Permissions Seeder [BEGIN]
                Permission::create(['name' => 'view category']);
                Permission::create(['name' => 'create category']);
                Permission::create(['name' => 'edit category']);
                Permission::create(['name' => 'delete category']);
            // Category Permissions Seeder [END]

            // User Permissions Seeder [BEGIN]
                Permission::create(['name' => 'view user']);
                Permission::create(['name' => 'create user']);
                Permission::create(['name' => 'edit user']);
                Permission::create(['name' => 'delete user']);
            // User Permissions Seeder [END]

            // // Permissions Seeder [BEGIN]
            //     Permission::create(['name' => 'view ']);
            //     Permission::create(['name' => 'create ']);
            //     Permission::create(['name' => 'edit ']);
            //     Permission::create(['name' => 'delete ']);
            // // Permissions Seeder [END]

        /**
         * ========================================
         *      Attach Permissions to Roles Seeder
         * ========================================
         */

            //  Give Permission to [ Admin Role ] [BEGIN]
                // give permissions to role
                $adminRole = Role::where('name', 'admin')->get()->first();
                $adminRole->givePermissionTo( Permission::all() );
                // assign role to user
                $adminUser = User::where('username', 'admin')->get()->first();
                $adminUser->assignRole('admin');
            //  Give Permission to [ Admin Role ] [END]

            //  Give Permission to [ General Manager Role ] [BEGIN]
                // give permissions to role
                $generalManagerRole = Role::where('name', 'general manager')->get()->first();
                // product type permissions
                $generalManagerRole->givePermissionTo('view product-type');
                $generalManagerRole->givePermissionTo('create product-type');
                $generalManagerRole->givePermissionTo('edit product-type');
                // product size permissions
                $generalManagerRole->givePermissionTo('view product-size');
                $generalManagerRole->givePermissionTo('create product-size');
                $generalManagerRole->givePermissionTo('edit product-size');
                // product permissions
                $generalManagerRole->givePermissionTo('view product');
                $generalManagerRole->givePermissionTo('edit product');
                // product variant permissions
                $generalManagerRole->givePermissionTo('view product-variant');
                $generalManagerRole->givePermissionTo('create product-variant');                
                $generalManagerRole->givePermissionTo('edit product-variant');                
                $generalManagerRole->givePermissionTo('delete product-variant');                                

                // assign role to user
                $satyaUser = User::where('username', 'satya')->get()->first();
                $satyaUser->assignRole('general manager');
            //  Give Permission to [ General Manager Role ] [END]

            //  Give Permission to [ Role ] [Begin]
                // give permissions to role

                // assign role to user

            //  Give Permission to [ Role ] [END]

    }
}
