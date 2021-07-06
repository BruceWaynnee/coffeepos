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

            // Access Dashboard Permissions Seeder [BEGIN]
                Permission::create(['name' => 'access dashboard']);
            // Access Dashboard Permissions Seeder [END]

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

            // Income Archive Permissions Seeder [BEGIN]
                Permission::create(['name' => 'view income-archive']);
                Permission::create(['name' => 'create income-archive']);
                Permission::create(['name' => 'edit income-archive']);
                Permission::create(['name' => 'delete income-archive']);
            // Income Archive Permissions Seeder [END]

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

            // Role Permissions Seeder [BEGIN]
                Permission::create(['name' => 'view role']);
                Permission::create(['name' => 'create role']);
                Permission::create(['name' => 'edit role']);
                Permission::create(['name' => 'delete role']);
            // Role Permissions Seeder [END]

            // Staff ( POS View ) Permissions Seeder [BEGIN]
                Permission::create(['name' => 'view pos']);
                Permission::create(['name' => 'create pos']);
                Permission::create(['name' => 'edit pos']);
                Permission::create(['name' => 'delete pos']);
            // Staff ( POS View ) Permissions Seeder [END]

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
                // dashboard accessing
                $generalManagerRole->givePermissionTo('access dashboard');
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

            //  Give Permission to [ Staff Role ] [Begin]
                // give permissions to role
                $staffRole = Role::where('name', 'staff')->get()->first();
                
                // pos view permissions
                $staffRole->givePermissionTo('view pos');
                $staffRole->givePermissionTo('create pos');
                $staffRole->givePermissionTo('edit pos');
                $staffRole->givePermissionTo('delete pos');

                // assign role to user
                $staffUser = User::Where('username', 'staff')->get()->first();
                $staffUser->assignRole('staff');
            //  Give Permission to [ Staff Role ] [END]
            
            //  Give Permission to [ Role ] [Begin]
                // give permissions to role

                // assign role to user

            //  Give Permission to [ Role ] [END]

    }
}
