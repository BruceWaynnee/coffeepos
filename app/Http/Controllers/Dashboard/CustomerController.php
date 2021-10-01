<?php

namespace App\Http\Controllers\Dashboard;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get customer records
        $customers = Customer::getCustomers();
        if(!$customers->data){
            return view('dashboard/index')->with('error', $customers->message);
        }
        $customers = $customers->data;
        
        return view( 'dashboard/modules/customer/index', compact('customers') );
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/modules/customer/add');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        // validate all request
        $requestValidResult = Customer::checkReuqestValidation(
            $request['name'],
            $request['discount'],
            $request['contact'],
            $request['email'],
        );
        if(!$requestValidResult->data){
            return back()->with('error', $requestValidResult->message);
        }
        dd($requestValidResult);

        // save customer
        try {
            DB::beginTransaction();

        } catch(QueryException $queryEx) {
            DB::rollBack();
            if($queryEx->errorInfo[1] == 1062){
                $message = 'Customer contact or email already exist!';
            }else {
                $message = 'There is a problem while trying to create customer, please contact us to fix the bugs!';
            }
            return back()->with('error', $message);
        }
        DB::commit();
        return redirect()->route('customer-list')
            ->with('success', 'Customer record created successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
