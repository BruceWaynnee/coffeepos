<?php

use App\Type;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            // frappe
            [
                'name' => 'frappe',
            ],

            // ice
            [
                'name' => 'iced',
            ],

            // hot
            [
                'name' => 'hot',
            ],

            //  
        ];

        // save records
        foreach($types as $type){
            Type::create($type);
        }
    }
}
