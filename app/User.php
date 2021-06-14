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

    /**
     * ########################
     *      Relationship
     * ########################
     */

}
