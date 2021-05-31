<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Table name
     * @var String
     */
    protected $table = 'categories';

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
     * Get all category records from database.
     * @return App/Model/Category
     */
    public static function getCategories(){
        $respond = (object)[];

        try{
            $categories = Category::all();
            $respond->data = $categories;
            $respond->message = 'Category records found';

        } catch(Exception $ex) {
            $respond->data = false;
            $respond->message = 'Problem occured while trying to get category!';
        }

        return $respond;
    }

    /**
     * Get specific category record base on given id from database.
     * @param Integer $id
     * @return App/Model/Category
     */
    public static function getCategory($id){
        $respond = (object)[];

        try{
            $category = Category::find($id);
            $respond->data = $category;
            $respond->message = 'Category record found';

        } catch(Exception $ex) {
            $respond->data = false;
            $respond->message = 'Invalid Category id record not found!';
        }

        return $respond;
    }

    /**
     * Check valid string value.
     * @param String $value
     * @return RespondObject [ data: result_data, message: result_message ] 
     */
    public static function checkValidString($value){
        // $value = preg_replace('/[\s$@_*]+/', ' ', $value);

        if ( !preg_match('/^[a-zA-Z0-9& ]*$/', $value) ) {
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
     * validation request data.
     * @param Form_Request_Value $name
     * @return RespondObject [ data: result_data, message: result_message ] 
     */
    public static function checkReuqestValidation($name){
        $respond = (object)[];

        // check valid name
        $nameResult = Category::checkValidString($name);
        if(!$nameResult->data){
            $nameResult->message = 'Category name is invalid!';
            $respond = $nameResult;
            return $respond;
        }

        $respond->name = strtolower($nameResult->data);

        $respond->data = true;
        $respond->message = 'All data are valided!';

        return $respond;
    }

     /**
     * ########################
     *      Relationship
     * ########################
     */ 

    /**
     * One category to many products.
     * @return App/Model/Product
     */
    public function products(){
        return $this->hasMany(
            Product::class,
            'category_id',
        );
    }

}
