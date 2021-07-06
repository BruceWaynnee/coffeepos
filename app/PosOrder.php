<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PosOrder extends Model
{
    /**
     * Table name
     * @var String 
     */
    protected $table = 'orders';

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
        'cashier',
        'customer',
        'grand_total',
        'order_number',
        'payment_receive',
        'payment_return',
        'income_archive_id',

    ];

    /**
     * ########################
     *     Helper Functions
     * ########################
     */

    // Pos Order Helper Functions [BEGIN]
        /**
         * Get all pos order records from database.
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getPosOrders(){
            $respond = (object)[];
            
            try {
                $posOrders = PosOrder::all();
                $respond->data    = $posOrders;
                $respond->message = 'Pos order records found';
            } catch(Exception $e) {
                $respond->data    = false;
                $respond->message = 'Problem occured while trying to get Pos order records!';
            }

            return $respond;
        }

        /**
         * Get specific pos order record from database.
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getPosOrder($id){
            $respond = (object)[];
            
            try {
                $posOrder = PosOrder::findOrFail($id);
                $respond->data    = $posOrder;
                $respond->message = 'Pos order record found';
            } catch(ModelNotFoundException $e) {
                $respond->data    = false;
                $respond->message = 'Pos order record not found';
            }

            return $respond;
        }

    // Pos Order Helper Functions [END]

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

    /**
     * ########################
     *      Relationship
     * ########################
     */

    /**
     * One order to many order details.
     * @return App/PosOrderDetail/
     */
    public function orderDetails(){
        return $this->hasMany(
            PosOrderDetail::class,
            'order_id',
        );
    }

    /**
     * Many orders to one income archive.
     * @return App/IncomeArchive/
     */
    public function incomeArchive(){
        return $this->belongsTo(
            IncomeArchive::class,
            'income_archive_id',
        );
    }

    /**
     * 
     */
}
