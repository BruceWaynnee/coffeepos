<?php

use App\Currency;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            // us dollar
            [
                'name'          => 'US Dollar',
                'code'          => 'us-dollar',
                'symbol'        => '$',
                'exchange_rate' => '1.00', // 1.00 dollar
            ],

            // khmer riel
            [
                'name'          => 'Khmer Riel',
                'code'          => 'kh-riel',
                'symbol'        => 'r',
                'exchange_rate' => '4100', // 4000 <-> 4100 riel
            ],

            // 
        ];

        // seed record into database
        foreach( $currencies as $currency ) {
            Currency::create( $currency );
        }

    }
}
