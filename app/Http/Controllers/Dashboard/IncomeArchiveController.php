<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\IncomeArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use function PHPUnit\Framework\isEmpty;

class IncomeArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get income archive records
        $incomeArchives = IncomeArchive::getIncomeArchives();
        if(!$incomeArchives->data){
            return back()->with('error', $incomeArchives->message);
        }
        $incomeArchives = $incomeArchives->data;
        return view( 'dashboard/modules/income_archive/index', compact('incomeArchives') );
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        // get income archive
        $incomeArchive = IncomeArchive::getIncomeArchive($id);
        if(!$incomeArchive->data){
            return back()->with('error', $incomeArchive->message);
        }
        $incomeArchive = $incomeArchive->data;

        $orders = $incomeArchive->orders;
        $incomeArchive->orderNumbers = $orders->pluck('order_number');

        $orderPvs = new Collection();
        foreach($orders as $order){
            foreach($order->orderDetails as $orderDetail){                
                $tmpOrderPvs = array(
                    'pvName'    => $orderDetail->pv_sku,
                    'unitPrice' => $orderDetail->unit_price,
                    'orderQty'  => $orderDetail->order_quantity,
                );
                $orderPvs->push($tmpOrderPvs);
            }
        }

        // sum order quantity on same product
        $orderPvArrs = array();
        foreach ($orderPvs as $orderPv) {
            if ( !isset( $orderPvArrs[ $orderPv['pvName'] ] ) ){
                $orderPvArrs[ $orderPv['pvName'] ] = $orderPv;
            } else {
                $orderPvArrs[ $orderPv['pvName'] ]['orderQty'] += $orderPv['orderQty'];
            }
        }
        $orderPvArrs = array_values($orderPvArrs); 
        
        return view( 'dashboard/modules/income_archive/detail', compact('incomeArchive', 'orderPvArrs') );
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
