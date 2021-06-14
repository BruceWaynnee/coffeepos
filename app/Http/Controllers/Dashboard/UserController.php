<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get user records
        $users = User::getUsers();
        if(!$users->data) {
            return back()->with('error', $users->message);
        }
        $users = $users->data;
        return view( 'dashboard/modules/user/index', compact('users') );
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get role records
        $roles = User::getRoles();
        if(!$roles->data){
            return back()->with('error', $roles->message);
        }
        $roles = $roles->data;
        return view('dashboard/modules/user/add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = User::getRole($request['role']);
        if(!$role->data){
            return back()->with('error', $role->message);
        }
        $role = $role->data;

        // validat all request
        $requestValidResult = User::checkReuqestValidation(
            $request['username'],
            $request['firstname'],
            $request['lastname'],
            $request['email'],
        );
        if(!$requestValidResult->data){
            return back()->with('error', $requestValidResult->message);
        }

        // save record
        try {
            DB::beginTransaction();

            $user = new User([
                'email'             => $requestValidResult->email,
                'username'          => $requestValidResult->username,
                'lastname'          => $requestValidResult->lastname,
                'firstname'         => $requestValidResult->firstname,
                'password'          => Hash::make($request['password']),
                'email_verified_at' => Carbon::now()->toDateTimeString(),
            ]);
            $user->save();

            // attach user with role
            $user->assignRole($role);

        }catch(QueryException $queryEx) {
            DB::rollBack();
            if($queryEx->errorInfo[1] == 1062){
                $message = 'Username or Email already exist!';
            }else {
                $message = 'There is a problem while trying to create user, please contact us to fix the bugs!';
            }
            return back()->with('error', $message);
        }
        DB::commit();
        return redirect()->route('user-list')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get role records
        $roles = User::getRoles();
        if(!$roles->data){
            return back()->with('error', $roles->message);
        }
        $roles = $roles->data;

        // get user record
        $user = User::getUser($id);
        if(!$user->data){
            return back()->with('error', $user->message);
        }
        $user = $user->data;
        return view('dashboard/modules/user/edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // get user record
        $user = User::getUser($id);
        if(!$user->data){
            return back()->with('error', $user->message);
        }
        $user = $user->data;

        // get role record
        $role = User::getRole($request['role']);
        if(!$role->data){
            return back()->with('error', $role->message);
        }
        $role = $role->data;

        // validat all request
        $requestValidResult = User::checkReuqestValidation(
            $request['username'],
            $request['firstname'],
            $request['lastname'],
            $request['email'],
        );
        if(!$requestValidResult->data){
            return back()->with('error', $requestValidResult->message);
        }
        // update record
        try {
            DB::beginTransaction();

            $user->username     = $requestValidResult->username;
            $user->firstname    = $requestValidResult->firstname;
            $user->lastname     = $requestValidResult->lastname;
            $user->email        = $requestValidResult->email;
            
            // password reset option
            if ( $request['password'] != null ){
                $user->password = Hash::make( $request['password'] );
            }

            $user->save();

            // detach user with old role
            $user->removeRole($user->roles->first()->name);
            // attach user with new role
            $user->assignRole($role);

        } catch(QueryException $queryEx) {
            DB::rollBack();
            if($queryEx->errorInfo[1] == 1062){
                $message = 'Username or Email already exist!';
            } else {
                $message = 'There is a problem while trying to create user, please contact us to fix the bugs!';
            }
            return redirect()->back()->with('error', $message);
        }

        DB::commit();
        return redirect()->route('user-list')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get user record
        $user = User::getUser($id);
        if(!$user->data){
            return back()->with('error', $user->message);
        }
        $user = $user->data;

        // delete record
        try{
            DB::beginTransaction();
            $user->roles()->detach();
            $user->permissions()->detach();
            $user->delete();

        } catch(ModelNotFoundException $e) {
            DB::rollBack();
            return back()->with('error', 'Problem occured while trying to delete user record, please contact us to fix the bugs!');
        }

        DB::commit();
        return redirect()->route('user-list')->with('success', 'User delete successfully');
    }
}
