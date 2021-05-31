<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductVaraint extends Model
{
    /**
     * Table name
     * @var String
     */
    protected $table = 'product_variants';

    /**
     * Primary key
     * @var String
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable
     * @var Array
     */
    protected $fillable = [
        'name',
        'price',
        'type_id',
        'size_id',
        'product_id',

    ];

    /**
     * ########################
     *     Helper Functions
     * ########################
     */

    // Product Variant Helper Functions [BEGIN]
        /**
         * Get all product variant records from database.
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getProductVariants(){
            $respond = (object)[];
            
            try {
                $productVariants = ProductVaraint::all();
                $respond->data    = $productVariants;
                $respond->message = 'Product variant records found';
            } catch(Exception $e) {
                $respond->data    = false;
                $respond->message = 'Problem occured while trying to get product variant records!';
            }

            return $respond;
        }

        /**
         * Get specific product variant record from database.
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getProductVariant($id){
            $respond = (object)[];
            
            try {
                $productVariant = ProductVaraint::findOrFail($id);
                $respond->data    = $productVariant;
                $respond->message = 'Product variant record found';
            } catch(ModelNotFoundException $e) {
                $respond->data    = false;
                $respond->message = 'Product variant record not found';
            }

            return $respond;
        }

    // Product Variant Helper Functions [END]

    // Product Helper Functions [BEGIN]
        /**
         * Get all product records from database.
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getProducts(){
            $respond = (object)[];
            
            try {
                $products = Product::all();
                $respond->data    = $products;
                $respond->message = 'Product records found';
            } catch(Exception $e) {
                $respond->data    = false;
                $respond->message = 'Problem occured while trying to get product records!';
            }

            return $respond;
        }

        /**
         * Get specific product record from database.
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getProduct($id){
            $respond = (object)[];
            
            try {
                $product = Product::findOrFail($id);
                $respond->data    = $product;
                $respond->message = 'Product record found';
            } catch(ModelNotFoundException $e) {
                $respond->data    = false;
                $respond->message = 'Product record not found';
            }

            return $respond;
        }

    // Product Helper Functions [END]

    // Type Help Functions [BEGIN]
        /**
         * Get all type records from database.
         * @return RespondObject = [ data: result_data, message: result_message]
         */
        public static function getTypes(){
            $respond = (object)[];

            try {
                $types = Type::all();
                $respond->data    = $types;
                $respond->message = 'All type records found';
            } catch(Exception $ex) {
                $respond->data    = false;
                $respond->message = 'Problem occured while trying to get type records from database!';
            }

            return $respond;
        }

        /**
         * Get all type records from database based on given type ids.
         * @param Array $typeIdArr
         * @return ObjectRespond [ data: data_result, message: message_result ]
         */
        public static function getTypesArr($typeIdArr){
            $respond = (object)[];
            
            $arrLength = count($typeIdArr);
            if($arrLength <= 0){ // check empty arr
                $respond->data    = false;
                $respond->message = 'Unable to add type to product variant, empty type provided!';
                return $respond;
            }

            try { // find records

                $typeCollection = new Collection();
                for($i=0; $i<$arrLength; $i++){
                    $types = Type::findOrFail($typeIdArr[$i]);
                    $typeCollection->push($types);
                }
                $respond->data    = $typeCollection;
                $respond->message = 'All types records found';
                
            } catch(ModelNotFoundException $ex) {
                $respond->data    = false;
                $respond->message = 'One of type ids does not exit, unable to create product variant, please double check type or refresh the page!';
            }

            return $respond;
        }

        /**
         * Get specific type records based on given id from database.
         * @param Integer $id
         * @return RespondObject = [ data: result_data, message: result_message]
         */
        public static function getType($id){
            $respond = (object)[];

            try {
                $type = Type::findOrFail($id);
                $respond->data    = $type;
                $respond->message = 'Type record found';
            } catch(Exception $ex) {
                $respond->data    = false;
                $respond->message = 'Type record not found!';
            }

            return $respond;
        }

    // Type Help Functions [END]

    // Size Help Functions [BEGIN]
        /**
         * Get all size records from database.
         * @return RespondObject = [ data: result_data, message: result_message]
         */
        public static function getSizes(){
            $respond = (object)[];

            try {
                $sizes = Size::all();
                $respond->data    = $sizes;
                $respond->message = 'All size records found';
            } catch(Exception $ex) {
                $respond->data    = false;
                $respond->message = 'Problem occured while trying to get size records from database!';
            }

            return $respond;
        }

        /**
         * Get all size records from database based on given size ids.
         * @param Array $sizeIdArr
         * @return ObjectRespond [ data: data_result, message: message_result ]
         */
        public static function getSizesArr($sizeIdArr){
            $respond = (object)[];
            
            $arrLength = count($sizeIdArr);
            if($arrLength <= 0){ // check empty arr
                $respond->data    = false;
                $respond->message = 'Unable to add size to product variant, empty size provided!';
                return $respond;
            }
            
            try { // find records
                $sizeCollection = new Collection();
                for($i=0; $i<$arrLength; $i++){
                    $sizes = Size::findOrFail($sizeIdArr[$i]);
                    $sizeCollection->push($sizes);
                }
                $respond->data    = $sizeCollection;
                $respond->message = 'All sizes records found';
                
            } catch(ModelNotFoundException $ex) {
                $respond->data    = false;
                $respond->message = 'One of size ids does not exit, unable to create product variant, please double check size or refresh the page!';
            }

            return $respond;
        }

        /**
         * Get specific size records based on given id from database.
         * @param Integer $id
         * @return RespondObject = [ data: result_data, message: result_message]
         */
        public static function getSize($id){
            $respond = (object)[];

            try {
                $size = Size::findOrFail($id);
                $respond->data    = $size;
                $respond->message = 'Size record found';
            } catch(Exception $ex) {
                $respond->data    = false;
                $respond->message = 'Size record not found!';
            }

            return $respond;
        }

    // Size Help Functions [END]

    /**
     * ########################
     *      Relationship
     * ########################
     */

    /**
     * Many product_variants to one product. 
     * @return App/Model/Product
     */
    public function product(){
        return $this->belongsTo(
            Product::class,
            'product_id',
        );
    }

    /**
     * Many product varaints to one type.
     * @return App/Model/Type
     */
    public function type(){
        return $this->belongsTo(
            Type::class,
            'type_id',
        );
    }

    /**
     * Many product varaints to one size.
     * @return App/Model/Type
     */
    public function size(){
        return $this->belongsTo(
            Size::class,
            'size_id',
        );
    }

    /**
     * ###################################
     *      Fast Validation Functions
     * ###################################
     */

}
