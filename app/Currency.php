<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Currency extends Model
{
    /**
     * Table name.
     * @var String
     */
    protected $table = 'currencies';

    /**
     * Primary key.
     * @var String
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass-assignable.
     * @var Array
     */
    protected $fillable = [
        'name',
        'code',
        'symbol',
        'exchange_rate',

    ];

    /**
     * ########################
     *     Helper Functions
     * ########################
     */

    // Currency Helper Functions [BEGIN]
        /**
         * Get all currency records from database.
         * @return ObjectRespond [ data: data_result, message: result_message ]
         */
        public static function getCurrencies(){
            $respond = (object)[];

            try {
                $currencies = self::all();
                $respond->data    = $currencies;
                $respond->message = 'Successful getting all currency records';
            } catch( Exception $ex ) {
                $respond->data    = false;
                $respond->message = 'Problem occured while trying to get currency records from database!';
            }

            return $respond;
        }

        /**
         * Get specific currency record based on given id 
         * parameter from database.
         * @param Integer $id
         * @return ObjectRespond [ data: data_result, message: result_message ]
         */
        public static function getCurrency( $id ) {
            $respond = (object)[];

            try {
                $currency = self::findOrFail( $id );
                $respond->data    = $currency;
                $respond->message = 'Currency record found';
            } catch( ModelNotFoundException $ex ) {
                $respond->data    = false;
                $respond->message = 'Currency record not found!';
            }

            return $respond;
        }

        /**
         * Get specific currency based on given symbol 
         * paramter from database.
         * @param String $symbol
         * @return ObjectRespond [ data: data_result, message: result_message ]
         */
        public static function getCurrencyBySymbol( $symbol ) {
            $respond = (object)[];

            try {
                $symbol   = strtolower( $symbol );
                $currency = self::where('symbol', $symbol)->get()->frist();
                $respond->data    = $currency;
                $respond->message = 'Currency record found';
            } catch( ModelNotFoundException | Exception $ex ) {
                $respond->data    = false;
                $respond->message = 'Currency record not found, please double check currency symbol again!';
            }

            return $respond;
        }
        
    // Currency Helper Functions [END]


    /**
     * ######################
     *     Relationships
     * ######################
     */

    /**
     * 
     */

}
