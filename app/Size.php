<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Size extends Model
{
    /**
     * Table name
     * @var String
     */
    protected $table = 'sizes';

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
     * Get all size records from database.
     * @return App/Model/Size
     */
    public static function getSizes(){
        $respond = (object)[];

        try {
            $sizes = Size::all();
            $respond->data    = $sizes;
            $respond->message = 'Size records found';
        } catch(Exception $ex) {
            $respond->data    = false;
            $respond->message = 'Problem occured while trying to get size recoreds!';
        }

        return $respond;
    }

    /**
     * Get specific size record by given id from database.
     * @param Integer $id
     * @return App/Model/Size
     */
    public static function getSize($id){
        $respond = (object)[];

        try {
            $size = Size::findOrFail($id);
            $respond->data    = $size;
            $respond->message = 'Size record found';
        } catch(ModelNotFoundException $ex) {
            $respond->data    = false;
            $respond->message = 'Size record not found!';
        }

        return $respond;
    }
    
    /**
     * ########################
     *      Relationship
     * ########################
     */ 

    /**
     * One size to many product variants.
     * @return App/Model/ProductVariant
     */
    public function productVariants(){
        return $this->hasMany(
            ProductVaraint::class,
            'size_id',
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
            $nameResult->message = 'Size name is invalid!';
            $respond = $nameResult;
            return $respond;
        }

        $respond->name = strtolower($nameResult->data);

        $respond->data = true;
        $respond->message = 'All data are valided!';

        return $respond;
    }


}
