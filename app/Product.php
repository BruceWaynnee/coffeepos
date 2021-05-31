<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Product extends Model
{
    /**
     * Table name
     * @var String
     */
    protected $table = 'products';

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
        'image',
        'category_id',
        'description',

    ];

    /**
     * ########################
     *     Helper Functions
     * ########################
     */

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
    
    // Category Helper Functions (BEGIN)
        /**
         * Get all category records from database.
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getCategories(){
            $respond = (object)[];
            
            try {
                $categories = Category::all();
                $respond->data    = $categories;
                $respond->message = 'Category records found';
            } catch(Exception $e) {
                $respond->data    = false;
                $respond->message = 'Problem occured while trying to get category records';
            }

            return $respond;
        }

        /**
         * Get specific category record from database.
         * @param Integer $id
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getCategory($id){
            $respond = (object)[];
            
            try {
                $category = Category::findOrFail($id);
                $respond->data    = $category;
                $respond->message = 'Category record found';
            } catch(ModelNotFoundException $e) {
                $respond->data    = false;
                $respond->message = 'Category record not found';
            }

            return $respond;
        }
    // Category Helper Functions (END)   

    /**
     * Check valid string that contain alphanumeric only without whitespace.
     * @param String $value
     * @return ObjectRespond [ data: result_data, message: result_message ]
     */
    public static function checkValidAlphanumericOnly($value){
        $respond = (object)[];

        if( !preg_match("/^([a-zA-Z0-9 ])+$/i", $value) ){
            $respond->data    = false;
            $respond->message = 'Value invalid, only alphanumeric with whitespace are allow';
        } else {
            $respond->data    = $value;
            $respond->message = 'Value valid';
        }

        return $respond;
    }

    /**
     * ########################
     *      Relationship
     * ########################
     */

    /**
     * Many products to one category.
     * @return App/Model/Category
     */
    public function category(){
        return $this->belongsTo(
            Category::class,
            'category_id',
        );
    }

    /**
     * One product to many product_variants.
     * @return App/Model/ProductVariant
     */
    public function productVariants(){
        return $this->hasMany(
            ProductVaraint::class,
            'product_id',
        );
    }

    /**
     * Many products to many attributes pivot table.
     * @return Collection [$productsAttributes]
     */
    
    /**
     * ###################################
     *      Fast Validation Functions
     * ###################################
     */
     
    /**
     * Valida request data.
     * @param Form_Request_Value $name
     * @return RespondObject [ data: result_data, message: result_message ] 
     */
    public static function checkRequestValidation( $name )
    {
        $respond = (object)[];

        // valid product name
        $nameResult = Product::checkValidAlphanumericOnly($name);
        if(!$nameResult->data) {
            $respond->data    = $nameResult->data;
            $respond->message = $nameResult->message . ' on product name!';
            return $respond;
        }

        $respond->data    = true;
        $respond->name    = strtolower($nameResult->data);
        $respond->message = 'All request data are valid.';

        return $respond;
    }

}
