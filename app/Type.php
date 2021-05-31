<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Type extends Model
{
    /**
     * Table name
     * @var String
     */
    protected $table = 'types';

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

    ];

    /**
     * ########################
     *     Helper Functions
     * ########################
     */

    /**
     * Get all type records from database.
     * @return App/Model/Type
     */
    public static function getTypes(){
        $respond = (object)[];

        try {
            $types = Type::all();
            $respond->data    = $types;
            $respond->message = 'Type records found';
        } catch(Exception $ex) {
            $respond->data    = false;
            $respond->message = 'Problem occured while trying to get type recoreds!';
        }

        return $respond;
    }

    /**
     * Get specific type record by given id from database.
     * @param Integer $id
     * @return App/Model/Type
     */
    public static function getType($id){
        $respond = (object)[];

        try {
            $type = Type::findOrFail($id);
            $respond->data    = $type;
            $respond->message = 'Type record found';
        } catch(ModelNotFoundException $ex) {
            $respond->data    = false;
            $respond->message = 'Type record not found!';
        }

        return $respond;
    }

    /**
     * Check valid string value.
     * @param String $value
     * @return RespondObject [ data: result_data, message: result_message ] 
     */
    public static function checkValidString($value){
        $value = preg_replace('/[\s$@_*]+/', ' ', $value);

        if ( !preg_match("/^[a-zA-Z0-9' ]*$/", $value) ) {
            $respond = (object) [
                'data'    => false,
                'message' => 'String is invalid!',
            ];
            return  $respond;
        } else {
            $respond = (object) [
                'data'    => $value,
                'message' => 'String is valid!',
            ];
            return  $respond;
        }
    }

    /**
     * ########################
     *      Relationship
     * ########################
     */ 

    /**
     * One type to many product variants.
     * @return App/Model/ProductVariant
     */
    public function productVariants(){
        return $this->hasMany(
            ProductVaraint::class,
            'type_id',
        );
    }
    
    /**
     * ###################################
     *      Fast Validation Functions
     * ###################################
     */ 

    /**
     * validation request data.
     * @param Form_Request_Value $name
     * @return RespondObject [ data: result_data, message: result_message ] 
     */
    public static function checkReuqestValidation($name){
        $respond = (object)[];

        // check valid name
        $nameResult = Category::checkValidString($name);
        if(!$nameResult->data){
            $nameResult->message = 'Type name is invalid!';
            $respond = $nameResult;
            return $respond;
        }

        $respond->name = strtolower($nameResult->data);

        $respond->data = true;
        $respond->message = 'All data are valided!';

        return $respond;
    }

}
