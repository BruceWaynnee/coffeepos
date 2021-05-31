<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Type;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get records
        $types = Type::getTypes();
        if(!$types->data){
            return view('dashboard/index')->with('error', $types->message);
        }
        $types = $types->data;
        return view('dashboard/modules/type/index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/modules/type/add');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validat all request values
        $requestResult = Type::checkReuqestValidation( $request['name'], );
        if(!$requestResult->data){
            return back()->with('error', $requestResult->message);
        }

        // save record
        try {
            DB::beginTransaction();
            
            $type = new Type([
                'name' => $requestResult->name,
            ]);
            $type->save();

        } catch (QueryException $queryEx) {
            DB::rollBack();
            if($queryEx->errorInfo[1] == 1062) {
                $message = 'Type already exist!';     
            } else {
                $message = 'Problem occured while tying to create type!';  
            }
            return back()->with('error', $message);
        }

        DB::commit();
        return redirect()->route('type-list')
            ->with('success', 'Type create successfully!');
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
        // get record
        $type = Type::getType($id);
        if(!$type->data){
            return back()->with('error', $type->message);
        }
        $type = $type->data;
        return view('dashboard/modules/type/edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // get record
        $type = Type::getType($id);
        if(!$type->data){
            return back()->with('error', $type->message);
        }
        $type = $type->data;

        // validat all request values
        $requestResult = Type::checkReuqestValidation( $request['name'], );
        if(!$requestResult->data){
            return back()->with('error', $requestResult->message);
        }

        // update record
        try {
            DB::beginTransaction();
            $type->name = $requestResult->name;
            $type->save();

        } catch (QueryException $queryEx) {
            DB::rollBack();
            if($queryEx->errorInfo[1] == 1062) {
                $message = 'Type already exist!';     
            } else {
                $message = 'Problem occured while tying to update type!';  
            }
            return back()->with('error', $message);
        }

        DB::commit();
        return redirect()
            ->route('type-list')->with('success', 'Type updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get record
        $type = Type::getType($id);
        if(!$type->data){
            return back()->with('error', $type->message);
        }
        $type = $type->data;

        // delete record
        try {
            $type->delete();
        } catch(Exception $ex) {
            if($ex->getCode() == "23000"){
                return back()
                    ->with('warning', 'Unable to delete this record due to 
                    [ Integrity Constraint Violation], you first need to 
                    detach all products that associated to this selected type!');
            } else {
                return back()
                    ->with('error','Problem occured while trying to delete type recored!');
            }
        }
        return redirect()->route('type-list')
        	    ->with('success', 'Type record deleted successfully');
    }
}
