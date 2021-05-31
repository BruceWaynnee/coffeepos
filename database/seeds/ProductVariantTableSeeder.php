<?php

use App\ProductVaraint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // ####### Coffee Drinks #######
            //
            // black coffee [begin]
                // iced size m 
                [
                    'name'       => 'black coffee iced m',
                    'price'      => 5,
                    'type_id'    => 2,
                    'size_id'    => 2,
                    'product_id' => 1,
                ],
                // iced size l
                [
                    'name'       => 'black coffee iced l',
                    'price'      => 5.5,
                    'type_id'    => 2,
                    'size_id'    => 3,
                    'product_id' => 1,
                ],
            // black coffee [end]
            // mocha        [begin]
                // hot one size
                [
                    'name'       => 'mocha hot',
                    'price'      => 5,
                    'type_id'    => 3,
                    'size_id'    => 4,
                    'product_id' => 2,
                ],
                // iced one size
                [
                    'name'       => 'mocha iced',
                    'price'      => 6,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 2,
                ],
                // frappe one size
                [
                    'name'       => 'mocha frappe',
                    'price'      => 6.5,
                    'type_id'    => 1,
                    'size_id'    => 4,
                    'product_id' => 2,
                ],
            // mocha        [end]
            // caramel macchiato [begin]
                // iced one size
                [
                    'name'       => 'caramel macchiato iced',
                    'price'      => 6.5,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 3,
                ],
                // frappe one size
                [
                    'name'       => 'caramel macchiato frappe',
                    'price'      => 7,
                    'type_id'    => 1,
                    'size_id'    => 4,
                    'product_id' => 3,
                ],

            // caramel macchiato [end]
            // honey lime black coffee [begin]
                // iced one size
                [
                    'name'       => 'honey lime black coffee iced',
                    'price'      => 6,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 4,
                ],
                
            // honey lime black coffee [end]
            // espresso [begin]
                // hot one size
                [
                    'name'       => 'espresso hot',
                    'price'      => 3.5,
                    'type_id'    => 3,
                    'size_id'    => 4,
                    'product_id' => 5,
                ],
            // espresso [end]
            // americano [begin]
                // hot one size
                [
                    'name'       => 'americano hot',
                    'price'      => 4,
                    'type_id'    => 3,
                    'size_id'    => 4,
                    'product_id' => 6,
                ],
                // iced one size
                [
                    'name'       => 'americano iced',
                    'price'      => 5,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 6,
                ],

            // americano [end]
            // latte [begin]
                // hot one size
                [
                    'name'       => 'latte hot',
                    'price'      => 4.5,
                    'type_id'    => 3,
                    'size_id'    => 4,
                    'product_id' => 7,
                ],
                // iced one size
                [
                    'name'       => 'latte iced',
                    'price'      => 5.5,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 7,
                ],
                // frappe one size
                [
                    'name'       => 'latte frappe',
                    'price'      => 6,
                    'type_id'    => 1,
                    'size_id'    => 4,
                    'product_id' => 7,
                ],
            // latte [end]
            // cappuccino [begin]
                // hot one size
                [
                    'name'       => 'cappuccino hot',
                    'price'      => 4.5,
                    'type_id'    => 3,
                    'size_id'    => 4,
                    'product_id' => 8,
                ],
                // iced one size
                [
                    'name'       => 'cappuccino iced',
                    'price'      => 5.5,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 8,
                ],
                // frappe one size
                [
                    'name'       => 'cappuccino frappe',
                    'price'      => 6,
                    'type_id'    => 1,
                    'size_id'    => 4,
                    'product_id' => 8,
                ],
            // cappuccino [end]
            // coffee marble [begin]
                // iced one size
                [
                    'name'       => 'coffee marble iced',
                    'price'      => 7,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 9,
                ],
            // coffee marble [end]
            // ####### Tea Drinks #######
            // 
            // tea [begin]
                // hot one size
                [
                    'name'       => 'tea hot',
                    'price'      => 3.5,
                    'type_id'    => 3,
                    'size_id'    => 4,
                    'product_id' => 10,
                ],
            // tea [end]
            // green tea latte [begin]
                // hot one size
                [
                    'name'       => 'green tea latte hot',
                    'price'      => 4.5,
                    'type_id'    => 3,
                    'size_id'    => 4,
                    'product_id' => 11,
                ],
                // iced one size
                [
                    'name'       => 'green tea latte iced',
                    'price'      => 5,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 11,
                ],
                // frappe one size
                [
                    'name'       => 'green tea latte frappe',
                    'price'      => 5.5,
                    'type_id'    => 1,
                    'size_id'    => 4,
                    'product_id' => 11,
                ],
            // green tea latte [end]
            // thai milk tea [begin]
                // hot one size
                [
                    'name'       => 'thai milk tea hot',
                    'price'      => 4.5,
                    'type_id'    => 3,
                    'size_id'    => 4,
                    'product_id' => 12,
                ],
                // iced one size
                [
                    'name'       => 'thai milk tea iced',
                    'price'      => 5,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 12,
                ],
                // frappe one size
                [
                    'name'       => 'thai milk tea frappe',
                    'price'      => 5.5,
                    'type_id'    => 1,
                    'size_id'    => 4,
                    'product_id' => 12,
                ],
            // thai milk tea [end]
            // lemon tea [begin]
                // iced one size
                [
                    'name'       => 'lemon tea iced',
                    'price'      => 5,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 13,
                ],
            // lemon tea end]
            // black tea [begin]
                // iced one size
                [
                    'name'       => 'black tea iced',
                    'price'      => 4.5,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 14,
                ],
            // black tea [end]
            // green tea honey lime with jelly [begin]
                // iced one size
                [
                    'name'       => 'green tea honey lime with jelly iced',
                    'price'      => 5.5,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 15,
                ],
            // green tea honey lime with jelly [end]
            // matcha latte [begin]
                // iced one size
                [
                    'name'       => 'matcha latte iced',
                    'price'      => 6,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 16,
                ],
            // matcha latte [end]
            // ######## Milk & Chocolate Drinks #########
            // 
            // fresh milk [begin]
                // hot one size
                [
                    'name'       => 'fresh milk hot',
                    'price'      => 3.5,
                    'type_id'    => 3,
                    'size_id'    => 4,
                    'product_id' => 17,
                ],
                // iced one size
                [
                    'name'       => 'fresh milk iced',
                    'price'      => 4,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 17,
                ],
                // frappe one size
                [
                    'name'       => 'fresh milk frappe',
                    'price'      => 4.5,
                    'type_id'    => 1,
                    'size_id'    => 4,
                    'product_id' => 17,
                ],
            // fresh milk [end]
            // chocolate [begin]
                // hot one size
                [
                    'name'       => 'chocolate hot',
                    'price'      => 5.5,
                    'type_id'    => 3,
                    'size_id'    => 4,
                    'product_id' => 18,
                ],
                // iced one size
                [
                    'name'       => 'chocolate iced',
                    'price'      => 6,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 18,
                ],
                // frappe one size
                [
                    'name'       => 'chocolate frappe',
                    'price'      => 6.5,
                    'type_id'    => 1,
                    'size_id'    => 4,
                    'product_id' => 18,
                ],
            // chocolate [end]
            // strawberry cheesecake [begin]
                // frappe one size
                [
                    'name'       => 'strawberry cheesecake',
                    'price'      => 6.5,
                    'type_id'    => 1,
                    'size_id'    => 4,
                    'product_id' => 19,
                ],
            // strawberry cheesecake [end]
            // ######## Juice & Smoothies #########
            // 
            // lychee juice [begin]
                // iced one size
                [
                    'name'       => 'lychee juice iced',
                    'price'      => 4.5,
                    'type_id'    => 2,
                    'size_id'    => 4,
                    'product_id' => 20,
                ],
                // frappe one size
                [
                    'name'       => 'lychee juice frappe',
                    'price'      => 5,
                    'type_id'    => 1,
                    'size_id'    => 4,
                    'product_id' => 20,
                ],
            // lychee juice [end]
            // fruity frappe [begin]
                // frappe one size
                [
                    'name'       => 'fruity frappe',
                    'price'      => 5.5,
                    'type_id'    => 1,
                    'size_id'    => 4,
                    'product_id' => 21,
                ],
            // fruity frappe [end]
            // yogurt smoothies [begin]
                // frappe one size
                [
                    'name'       => 'yogurt smoothies frappe',
                    'price'      => 6.5,
                    'type_id'    => 1,
                    'size_id'    => 4,
                    'product_id' => 22,
                ],
            // yogurt smoothies [end]
        ];
    
        // save records
        foreach($data as $dataRow){
            ProductVaraint::create($dataRow);
        }
    }
}
