<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [ 'name' => 'coffee'          ],
            [ 'name' => 'tea'             ],
            [ 'name' => 'milk / chocolate'  ],
            [ 'name' => 'juice & smoothies' ],
        ];
        
        // save to database
        foreach($categories as $category){
            Category::create($category);
        }
    }
}
