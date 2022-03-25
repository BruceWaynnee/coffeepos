<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Customer extends Model
{
    /**
     * Table name
     * @var String
     */
    protected $table = 'customers';

    /**
     * Primary key
     * @var String
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     * @var Array
     */
    protected $fillable = [
        'name',
        'point',
        'email',
        'contact',
        'discount',

    ];

    /**=====================
     *   Helper Functions
    ========================*/

    // Customer Helper Functions [BEING]
        /**
         * Get all customer records from database.
         * @return ObjectRespond [ data: data_result; message = message_result ]
         */
        public static function getCustomers(){
            $respond = (object)[];

            try {
                $customers = Customer::all();
                $respond->data    = $customers;
                $respond->message = 'All customer records found';
            } catch(Exception $ex) {
                $respond->data    = false;
                $respond->message = 'Problem occured while trying to get all customer records!';
            }

            return $respond;
        }
        /**
         * Get specific customer record based on given id 
         * from database.
         * @param Integer $id
         * @return ObjectRespond [ data: data_result; message = message_result ]
         */
        public static function getCustomer($id){
            $respond = (object)[];

            try {
                $customer = Customer::findOrFail($id);
                $respond->data    = $customer;
                $respond->message = 'Customer record found';
            } catch(ModelNotFoundException $ex) {
                $respond->data    = false;
                $respond->message = 'Customer record not found!';
            }

            return $respond;
        }

        /**
         * Get default customer ( walk in customer ) record from database.
         * @return ObjectRespond [ data: data_result, message: result_message ]
         */
        public static function getWalkInCustomer(){
            $respond = (object)[];

            try {
                $walkInCustomer   = Customer::where('email', 'walkin@coffee.com')
                                        ->get()
                                        ->first();
                $respond->data    = $walkInCustomer;
                $respond->message = 'Walk-In customer record found';

            } catch( ModelNotFoundException | Exception $ex ) {
                $respond->data    = false;
                $respond->message = 'Walk-In customer not found!';
            }

            return $respond;
        }

    // Customer Helper Functions [END]

    /**====================
     *    Relationships
     ======================*/
    
    /**
     * One customer to many orders
     * @return App\Model\PosOrder
     */
    public function orders(){
        return $this->hasMany(
            PosOrder::class,
            'customer_id',
        );
    }

    /**
     * 
     */

}
