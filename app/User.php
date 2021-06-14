<?php

namespace App;

use Exception;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * Table name.
     * @var string
     */
    protected $table = 'users';

    /**
     * Primary key.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'email',
        'password',
        'email_verified_at',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ########################
     *     Helper Functions
     * ########################
     */

    // User Helper Functions [BEGIN]
        /**
         * Get all user records from database.
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getUsers(){
            $respond = (object)[];
            
            try {
                $users = User::all();
                $respond->data    = $users;
                $respond->message = 'User records found';
            } catch(Exception $e) {
                $respond->data = false;
                $respond->message = 'Problem occured while trying to get user records!';
            }

            return $respond;
        }

        /**
         * Get specific user record based on giving id from database.
         * @param Integer $id
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getUser($id){
            $respond = (object)[];
            
            try {
                $user = User::findOrFail($id);
                $respond->data    = $user;
                $respond->message = 'User record found';
            } catch(ModelNotFoundException $e) {
                $respond->data = false;
                $respond->message = 'User record not found!';
            }

            return $respond;
        }
    // User Helper Functions [END]

    // Role Helper Functions [BEGIN]
        /**
         * Get all role records from database.
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getRoles() {
            $respond = (object)[];

            try {
                $roles = Role::all();
                $respond->data    = $roles;
                $respond->message = 'Role records found';             
            } catch(Exception $e) {
                $respond->data    = false;
                $respond->message = 'Problem occured while trying to get role records!';
            }

            return $respond;
        }

        /**
         * Get specific role record from database.
         * @param Integer $id
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getRole($id) {
            $respond = (object)[];

            try {
                $role = Role::findOrFail($id);
                $respond->data    = $role;
                $respond->message = 'Role record found';             
            } catch(ModelNotFoundException $e) {
                $respond->data    = false;
                $respond->message = 'Role record not found!';             
            }

            return $respond;
        }
    // Role Helper Functions [END]

    // Permission Helper Functions [BEGIN]
        /**
         * Get all permission records from database.
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getPermissions() {
            $respond = (object)[];

            try {
                $permissions = Permission::all();
                $respond->data    = $permissions;
                $respond->message = 'Permission records found';             
            } catch(Exception $e) {
                $respond->data    = false;
                $respond->message = 'Problem occured while trying to get permission records!';
            }

            return $respond;
        }

        /**
         * Get specific permission record from database.
         * @param Integer $id
         * @return RespondObject [ data: result_data, message: result_message ] 
         */
        public static function getPermission($id) {
            $respond = (object)[];

            try {
                $permission = Permission::findOrFail($id);
                $respond->data    = $permission;
                $respond->message = 'permission record found';             
            } catch(ModelNotFoundException $e) {
                $respond->data    = false;
                $respond->message = 'permission record not found!';             
            }

            return $respond;
        }
    // Permission Helper Functions [END]

    /**
     * Check valid email value.
     * @param String $email
     * @return RespondObject [ data: result_data, message: result_message ] 
     */
    protected static function checkValidEmail($email){
        if (!preg_match("/^[\w.-]+[@]+[a-z]+\.+[a-z]*$/", $email)) {
            $respond = (object) [
                'data'    => false,
                'message' => 'Email is invalid!',
            ];
            return  $respond;
        } else {
            $respond = (object) [
                'data'    => $email,
                'message' => 'Email is valid!',
            ];
            return  $respond;
        }
    }

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
     * @param Form_Request_Value $discountValue
     * @return RespondObject [ data: result_data, message: result_message ] 
     */
    public static function checkReuqestValidation($username, $firstname, $lastname, $email){
        $respond = (object)[];

        // check valid username
        $usernameResult = User::checkValidString($username);
        if(!$usernameResult->data){
            $usernameResult->message = 'Invalid username value, only string are allow!';
            return $usernameResult;
        }

        // check valid firstname
        $firstnameResult = User::checkValidString($firstname);
        if(!$firstnameResult->data){
            $firstnameResult->message = 'Invalid firstname value, only string are allow!';
            return $firstnameResult;
        }

        // check valid lastname
        $lastnameResult = User::checkValidString($lastname);
        if(!$lastnameResult->data){
            $lastnameResult->message= 'Invalid firstname value, only string are allow!';
            return $lastnameResult;
        }

        // check valid email
        $emailResult = User::checkValidEmail($email);
        if(!$emailResult->data) {
            $respond = $emailResult;
            return $respond;
        }

        $respond->data = true;
        $respond->email     = strtolower($emailResult->data);
        $respond->username  = strtolower($usernameResult->data);
        $respond->lastname  = strtolower($lastnameResult->data);
        $respond->firstname = strtolower($firstnameResult->data);
        $respond->message   = 'All request are valid';

        return $respond;
    }

}
