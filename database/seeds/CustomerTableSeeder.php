<?php

use App\Customer;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // customer data
        $customers = [
            // walk in customer
            [
                'name'     => 'walk in customer',
                'email'    => 'walkin@coffee.com',
                'contact'  => '0',
                'discount' => 0.00,
                'point'    => 0,
            ],

            // promotion customer
            [
                'name'     => 'promotion customer',
                'email'    => 'promotion@coffee.com',
                'contact'  => '1',
                'discount' => 10.00,
                'point'    => 0,
            ],

            // 
        ];

        // save into database
        foreach($customers as $customer){
            Customer::create($customer);
        }
    }
}
