<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Size;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::getSizes();
        if(!$sizes->data){
            return view('dashboard/index')->with('error', $sizes->message);
        }
        $sizes = $sizes->data;
        return view('dashboard/modules/size/index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/modules/size/add');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validat all request values
        $requestResult = Size::checkReuqestValidation( $request['name'], );
        if(!$requestResult->data){
            return back()->with('error', $requestResult->message);
        }

        // save record
        try {
            DB::beginTransaction();
            
            $size = new Size([  
                'name' => $requestResult->name,
            ]);
            $size->save();

        } catch (QueryException $queryEx) {
            DB::rollBack();
            if($queryEx->errorInfo[1] == 1062) {
                $message = 'Size already exist!';     
            } else {
                $message = 'Problem occured while trying to create size!';  
            }
            return back()->with('error', $message);
        }

        DB::commit();
        return redirect()->route('size-list')
            ->with('success', 'Size create successfully!');
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
        $size = Size::getSize($id);
        if(!$size->data){
            return back()->with('error', $size->message);
        }
        $size = $size->data;
        return view('dashboard/modules/size/edit', compact('size'));
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
        $size = Size::getSize($id);
        if(!$size->data){
            return back()->with('error', $size->message);
        }
        $size = $size->data;

        // validat all request values
        $requestResult = Size::checkReuqestValidation( $request['name'], );
        if(!$requestResult->data){
            return back()->with('error', $requestResult->message);
        }

        // update record
        try {
            DB::beginTransaction();
            $size->name = $requestResult->name;
            $size->save();

        } catch (QueryException $queryEx) {
            DB::rollBack();
            if($queryEx->errorInfo[1] == 1062) {
                $message = 'Size already exist!';     
            } else {
                $message = 'Problem occured while trying to update size!';  
            }
            return back()->with('error', $message);
        }

        DB::commit();
        return redirect()->route('size-list')
            ->with('success', 'Size updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get record
        $size = Size::getSize($id);
        if(!$size->data){
            return back()->with('error', $size->message);
        }
        $size = $size->data;

        // delete record
        try {
            $size->delete();
        } catch(Exception $ex) {
            if($ex->getCode() == "23000"){
                return back()
                    ->with('warning', 'Unable to delete this record due to 
                    [ Integrity Constraint Violation], you first need to 
                    detach all products that associated to this selected size!');
            } else {
                return back()
                    ->with('error','Problem occured while trying to delete size recored!');
            }
        }
        return redirect()->route('size-list')
        	    ->with('success', 'Size record deleted successfully');
    }
}
