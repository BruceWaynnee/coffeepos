<?php

namespace App\Http\Controllers\Dashboard;

use Exception;

use App\Role;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Spatie\Permission\Models\Role as SpatieRole;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get records
        $roles = Role::getRoles();
        if(!$roles->data){
            return view('dashboard/index')->with('error', $roles->message);
        }
        $roles = $roles->data;
        return view('dashboard/modules/role/index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get permission records
        $permissions = Role::getPermissions();
        if(!$permissions->data){
            return back()->with('error', $permissions->message);
        }
        $permissions = $permissions->data;
        return view('dashboard/modules/role/add', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // get permisson records
        $permissions = Role::getArrPermissions($request['permissions']);
        if(!$permissions->data){
            return back()->with('error', $permissions->message);
        }
        $permissions = $permissions->data;

        // valid all request
        $requestValidResult = Role::checkReuqestValidation(
            $request['name'],
        );
        if(!$requestValidResult->data){
            return back()->with('error', $requestValidResult->message);
        }       
        
        // save record
        try {
            DB::beginTransaction();
            
            // create role
            $role = new SpatieRole([
                'name' => $requestValidResult->name,
            ]);
            $role->save();

            // attach permission to role
            foreach($permissions as $permission){
                $role->givePermissionTo($permission->name);
            }

        } catch(QueryException $queryEx) {
            DB::rollBack();
            if( $queryEx->errorInfo[1] == 1062){
                $message = 'Role name already exist, please choose another name and create again!';
            } else {
                $message = 'Problem while trying to create role record, please contact us to fix the bugs!';
            }
            return back()->with('error', $message);
        }

        DB::commit();
        return redirect()->route('role-list')
            ->with('success', 'Role record create successfully');
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
        // get role record
        $role = Role::getRole($id);
        if(!$role->data){
            return back()->with('error', $role->message);
        }
        $role = $role->data;

        // permissions that belong to current role
        $permissionIdsArr = [];
        foreach($role->permissions as $permission){
            array_push($permissionIdsArr, $permission->id);
        }
        $permissionIdsArr = json_encode($permissionIdsArr);

        // get permission records
        $permissions = Role::getPermissions();
        if(!$permissions->data){
            return back()->with('error', $permissions->message);
        }
        $permissions = $permissions->data;
        return view('dashboard/modules/role/edit', compact('role','permissions', 'permissionIdsArr'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // get role record
        $role = Role::getRole($id);
        if(!$role->data){
            return back()->with('error', $role->message);
        }
        $role = $role->data;

        // get permisson records
        $permissions = Role::getArrPermissions($request['permissions']);
        if(!$permissions->data){
            return back()->with('error', $permissions->message);
        }
        $permissions = $permissions->data;

        // valid all request
        $requestValidResult = Role::checkReuqestValidation(
            $request['name'],
        );
        if(!$requestValidResult->data){
            return back()->with('error', $requestValidResult->message);
        }

        // update record
        try {
            DB::beginTransaction();
            
            // update role
            $role->name = $requestValidResult->name;
            
            // detach all permissions of current role
            foreach($role->permissions as $oldPermission){
                $role->revokePermissionTo($oldPermission->name);
            }

            // attach permission to role
            foreach($permissions as $newPermission){
                $role->givePermissionTo($newPermission->name);
            }
            $role->save();

        } catch(QueryException $queryEx) {
            DB::rollBack();
            if( $queryEx->errorInfo[1] == 1062){
                $message = 'Role name already exist!';
            } else {
                $message = 'Problem while trying to update role record, please contact us to fix the bugs!';
            }
            return back()->with('error', $message);
        }

        DB::commit();
        return redirect()->route('role-list')
            ->with('success', 'Role record update successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get role record
        $role = Role::getRole($id);
        if(!$role->data){
            return back()->with('error', $role->message);
        }
        $role = $role->data;

        // delete record
        try {
            DB::beginTransaction();
            $role->delete();

        } catch(Exception $ex) {
            DB::rollBack();
            return back()->with('error', 'Problem occured while trying to delete role recored!');
        }
        DB::commit();
        return redirect()->route('role-list')->with('success', 'Role record deleted successfully');
    }
}
