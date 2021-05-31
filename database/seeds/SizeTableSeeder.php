<?php

use App\Size;
use Illuminate\Database\Seeder;

class SizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            // s
            [ 'name' => 's' ],
            // m
            [ 'name' => 'm' ],
            // l
            [ 'name' => 'l' ],
            // one size
            [ 'name' => 'one size' ],
        ];

        // save records
        foreach($sizes as $size){
            Size::create($size);
        }
    }
}
