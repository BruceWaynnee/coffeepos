<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Currency;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get curreny records
        $currencies = Currency::getCurrencies();
        if( !$currencies->data ){
            return back()->with('error', $currencies->message);
        }
        $currencies = $currencies->data;

        return view( 'dashboard.modules.currency.index', compact( 'currencies' ) );
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        // get currency record
        $currency = Currency::getCurrency( $id );
        if( !$currency->data ) {
            return back()->with('error', $currency->message);
        }
        $currency = $currency->data;

        return view( 'dashboard.modules.currency.edit', compact( 'currency' ) );
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // get currency record
        $currency = Currency::getCurrency( $id );
        if( !$currency->data ){
            return back()->with('error', $currency->message);
        }
        $currency = $currency->data;

        // update record
        try {
            DB::beginTransaction();

            $currency->name          = $request['name'];
            $currency->code          = $request['code'];
            $currency->exchange_rate = $request['exchange_rate'];

            $currency->save();

        } catch( QueryException $ex ) {
            DB::rollBack();
            return back()->with('error', 'Currency record duplicated or fields already exist, please check again!');
        }

        DB::commit();
        return redirect()->route('currency-list')->with('success', 'Currency record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get currency record
        $currency = Currency::getCurrency( $id );
        if( !$currency->data ){
            return back()->with('error', $currency->message);
        }
        $currency = $currency->data;

        // delete record
        try {
            DB::beginTransaction();
            
            $currency->delete();

        } catch( Exception $ex ) {
            DB::rollBack();
            return back()->with('error', 'Problem occured while trying to delete currency record from database!');
        }

        DB::commit();
        return redirect()->route('currency-list')->with('success', 'Currency record delete successfully');
    }
}
