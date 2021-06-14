<?php

namespace App;

use Exception;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission as SpatiePermission;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Role extends Model
{

    /**
     * ############################
     *      Helper functions
     * ############################
     */
    
    // Role Helper Functions [BEGIN]

        /**
         * Get all role records from database.
         * @return RespondObject [ data: data_result, message: result_message ]
         */
        public static function getRoles(){
            $respond = (object)[];

            try {
                $roles = SpatieRole::all();
                $respond->data    = $roles;
                $respond->message = 'All role records found';
            } catch(Exception $ex) {
                $respond->data    = false;
                $respond->message = 'Problem occured while trying to get role records from database!';
            }

            return $respond;
        }

        /**
         * Get specific role record from database based on given id.
         * @param Integer $id
         * @return ObjectRespond [ data: data_result, message: result_message ]
         */
        public static function getRole($id){
            $respond = (object)[];

            try {
                $role = SpatieRole::findOrFail($id);
                $respond->data    = $role;
                $respond->message = 'Role record found';
            } catch(ModelNotFoundException $ex) {
                $respond->data    = false;
                $respond->message = 'Role record not found!';
            }

            return $respond;
        }

    // Role Helper Functions [END]

    // Permission Helper Functions [BEGIN]

        /**
         * Get all permission records from database.
         * @return ObjectRespond [ data: data_result, message: result_message ]
         */
        public static function getPermissions(){
            $respond = (object)[];
            
            try {
                $permissions = SpatiePermission::all();
                $respond->data    = $permissions;
                $respond->message = 'Permission records found';
            } catch(Exception $ex) {
                $respond->data    = false;
                $respond->message = 'Problem occured while trying to get permission records!';
            }

            return $respond;
        }

        /**
         * Get specific permission record based on given id.
         * @param Integer $id
         * @return ObjectRespond [ data: data_result, message: result_message ]
         */
        public static function getPermission($id){
            $respond = (object)[];

            try {
                $permission = SpatiePermission::findOrFail($id);
                $respond->data    = $permission;
                $respond->message = 'Permission record found';
            } catch(ModelNotFoundException $ex) {
                $respond->data    = false;
                $respond->message = 'Permission record not found!';
            }

            return $respond;
        }

        /**
         * Check valid array of permission ids.
         * @param Array $permissionsIdArr
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getArrPermissions($permissionsIdArr){
            $respond = (object)[];
            $arrayLength = count($permissionsIdArr);

            $permissions = SpatiePermission::find($permissionsIdArr);
            if($permissions == null){
                $respond->data = false;
                $respond->message = 'Permission ids is invalid, enable to get data!';
                return $respond;
            }

            if($arrayLength != count($permissions)){
                $respond->data = false;
                $respond->message = 'One of the permission id not found!';
                return $respond;
            }

            $respond->data = $permissions;
            $respond->message = 'All permission ids are found';

            return $respond;
        }

    // Permission Helper Functions [END]

    /**
     * Check valid name value.
     * @param String $name
     * @return RespondObject [ data: result_data, message: result_message ] 
     */
    protected static function checkValidString($name){
        if (!preg_match("/^[a-zA-Z0-9' ]*$/",$name)) {
            $respond = (object) [
                'data'    => false,
                'message' => 'String is invalid!',
            ];
            return  $respond;
        } else {
            $respond = (object) [
                'data'    => $name,
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
     * 
     */

    /**
     * ##################################
     *      Fast Validation Functions
     * ##################################
     */

    /**
     * validation request data.
     * @param Form_Request_Value $name
     * @return RespondObject [ data: result_data, message: result_message ] 
     */
    public static function checkReuqestValidation($name){
        $respond = (object)[];

        // check name
        $nameResult = Role::checkValidString($name);
        if(!$nameResult->data){
            $respond->data    = false;
            $respond->message = 'Role name invalid! Only alphanumeric with whitespace are available!';
            return $respond;
        }

        // 

        $respond->data    = true;
        $respond->name = strtolower($nameResult->data);
        $respond->message = 'All request valided';

        return $respond;
    }

}
