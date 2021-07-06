<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class IncomeArchive extends Model
{
    /**
     * Table name.
     * @var String
     */
    protected $table = 'income_archives';

    /**
     * Primary key.
     * @var String
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     * @var Array
     */
    protected $fillAble = [
        'staff',
        'end_date',
        'start_date',
        'total_expense',
        'total_revenue',
        'total_net_income',
        'total_order_made',

    ];

    /**
     * ########################
     *     Helper Functions
     * ########################
     */

    // Income Archive Helper Functions [BEGIN]
        /**
         * Get all income archive records from database.
         * @return RespondObject [ data: result_data, message:result_message ]
         */
        public static function getIncomeArchives(){
            $respond = (object)[];

            try {
                $incomeArchives   = IncomeArchive::all();
                $respond->data    = $incomeArchives;
                $respond->message = 'All income archive records found';
            } catch(Exception $ex) {
                $respond->data    = false;
                $respond->message = 'Problem occured while trying to get income archive records!';
            }

            return $respond;
        }

        /**
         * Get specific income archive record based on given id
         * from database.
         * @param Integer $id
         * @return RespondObject [ data: result_data, message:result_message ]
         */
        public static function getIncomeArchive($id){
            $respond = (object)[];

            try {
                $incomeArchive    = IncomeArchive::findOrFail($id);
                $respond->data    = $incomeArchive;
                $respond->message = 'Income archive record found';
            } catch(ModelNotFoundException $ex) {
                $respond->data    = false;
                $respond->message = 'Income archive record not found!';
            }

            return $respond;
        }
    // Income Archive Helper Functions [END]
    
    // Order Helper Functions [BEGIN]
        /**
         * Get all order records from database.
         * @return ObjectRespond [ data: result_data, message: result_message]
         */
        public static function getOrders(){
            $respond = (object)[];

            try {
                $orders = PosOrder::all();
                $respond->data    = $orders;
                $respond->message = 'All order records found';
            } catch(Exception $ex) {
                $respond->data    = false;
                $respond->message = 'Problem occured while trying to get order records!';
            }

            return $respond;
        }
        /**
         * Get specific order record based on given id
         * from database.
         * @param Integer $id
         * @return RespondObject [ data: result_data, message:result_message ]
         */
        public static function getOrder($id){
            $respond = (object)[];

            try {
                $order = PosOrder::findOrFail($id);
                $respond->data    = $order;
                $respond->message = 'order record found';
            } catch(ModelNotFoundException $ex) {
                $respond->data    = false;
                $respond->message = 'order record not found!';
            }

            return $respond;
        }
    // Order Helper Functions [END]

    /**
     * ########################
     *      Relationship
     * ########################
     */

    /**
     * One income archive to many orders
     * @return App/PosOrder
     */
    public function orders(){
        return $this->hasMany(
            PosOrder::class,
            'income_archive_id',
        );
    }

    /**
     * 
     */

}
