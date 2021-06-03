<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Exception;
use Illuminate\Http\Request;

class ApiProductVariantController extends Controller
{
    /**
     * 
     */
    public function getProductVariants($productId){
        $respond = (object)[
            'data'   => null,
            'status' => 'failed',
        ];

        // check product record
        $product = Product::getProduct($productId);
        if(!$product->data){
            $respond->message = $product->message;
            return response()->json_encode($respond);
        }
        $product = $product->data;

        // get productvariants
        try {
            $productVariants = $product->productVariants;
            
            // productvariant attributes ready to use [type, size]
            foreach( $productVariants as $productVariant ){
                $productVariant->size = $productVariant->size;
                $productVariant->type = $productVariant->type;
            }

            $respond->status = 'success';
            $respond->data = $productVariants;
            $respond->message = 'Product variants record found';

        } catch(Exception $e) {
            $respond->message = 'product variants record not found!';
        }

        return json_encode($respond);
    }

}
