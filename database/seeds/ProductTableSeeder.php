<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            // coffee products [begin]
                // black coffee
                [
                    'category_id' => 1,
                    'name'        => 'black coffee',
                ],
                // mocha
                [
                    'category_id' => 1,
                    'name'        => 'mocha',
                ],
                // caramel macchiato
                [
                    'category_id' => 1,
                    'name'        => 'caramel macchiato',
                ],
                // honey lime black coffee
                [
                    'category_id' => 1,
                    'name'        => 'honey lime black coffee',
                ],
                // espresso
                [
                    'category_id' => 1,
                    'name'        => 'espresso',
                ],
                // americano
                [
                    'category_id' => 1,
                    'name'        => 'americano',
                ],
                // latte
                [
                    'category_id' => 1,
                    'name'        => 'latte',
                ],
                // cappuccino
                [
                    'category_id' => 1,
                    'name'        => 'cappuccino',
                ],
                // coffee marble
                [
                    'category_id' => 1,
                    'name'        => 'coffee marble',
                ],
                // 

            // coffee products [end]
            // tea    products [begin]
                // tea 
                [
                    'category_id' => 2,
                    'name'        => 'tea',
                ],
                // green tea latte
                [
                    'category_id' => 2,
                    'name'        => 'green tea latte',
                ],
                // thai milk tea 
                [
                    'category_id' => 2,
                    'name'        => 'thai milk tea',
                ],
                // lemon tea
                [
                    'category_id' => 2,
                    'name'        => 'lemon tea',
                ],
                // black tea 
                [
                    'category_id' => 2,
                    'name'        => 'black tea',
                ],
                // green tea honey lime with jelly 
                [
                    'category_id' => 2,
                    'name'        => 'green tea honey lime with jelly',
                ],
                // matcha latte 
                [
                    'category_id' => 2,
                    'name'        => 'matcha latte',
                ],
                // 
            // tea    products [end]
            // milk & chocolate  products [begin]
                // fresh milk
                [
                    'category_id' => 3,
                    'name'        => 'fresh milk',
                ],
                // chocolate
                [
                    'category_id' => 3,
                    'name'        => 'chocolate',
                ],
                // strawberry cheesecake
                [
                    'category_id' => 3,
                    'name'        => 'strawberry cheesecake',
                ],
                // 
            // milk & chocolate  products [end]
            // juice & smoothies products [begin]
                // lychee juice
                [
                    'category_id' => 4,
                    'name'        => 'lychee juice',
                ],
                // fruity frappe
                [
                    'category_id' => 4,
                    'name'        => 'fruity frappe',
                    'description' => '(strawberry/mixed berry)',
                ],
                // lychee juice
                [
                    'category_id' => 4,
                    'name'        => 'yogurt frappe',
                    'description' => '(strawberry/mixed berry)',
                ],
                // 
            // juice & smoothies products [end]

        ];

        // save records
        foreach($products as $product) {
            Product::create($product);
        }

    }
}
