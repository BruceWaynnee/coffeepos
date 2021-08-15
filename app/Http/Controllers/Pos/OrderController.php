<?php

namespace App\Http\Controllers\Pos;

use App\PosOrder;
use App\PosOrderDetail;
use App\Http\Controllers\Controller;
use App\IncomeArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // get income archive id from session
        $incomeArchiveId = IncomeArchive::getIncomeArchiveSession();
        if(!$incomeArchiveId->data){
            return back()->with('error', $incomeArchiveId->message .', unable to process order!');
        }
        $incomeArchiveId = $incomeArchiveId->data;

        // get productvariant record
        $productVariants = PosOrder::getProductVariant( json_decode($request['productVariantIdsArr']) );
        if(!$productVariants->data){
            return back()->with('error', $productVariants->message .', unable to process order!');
        }
        $productVariants = $productVariants->data;

        // get customer record
        $customer = PosOrder::getCustomer($request['customer']);
        if(!$customer->data){
            return back()->with('error', $customer->message);
        }
        $customer = $customer->data;

        // validate all request data from front end
        $requestValidation = PosOrder::validateRequestData($request['paymentOption']);
        if(!$requestValidation->data){
            return back()->with('error', $requestValidation->message);
        }

        // save pos order
        try {
            DB::beginTransaction();

            $currentUser = Auth::user();

            $discountPercentage = $customer->discount;
            $grandTotal     = number_format( (float)$request['subTotal'], 2, '.', '' );
            $grandTotal = $grandTotal-($grandTotal * ($discountPercentage/100));
            $paymentReceive = number_format( (float)$request['totalPaymentMade'], 2, '.', '' );
            $paymentReturn  = ($paymentReceive - $grandTotal);

            $posOrder = new PosOrder([
                'grand_total'       => $grandTotal,
                'payment_receive'   => $paymentReceive,
                'payment_return'    => $paymentReturn,
                'customer_id'       => $customer->id,
                'cashier'           => $currentUser->username,
                'payment_option'   => $requestValidation->paymentOption,
                'income_archive_id' => $incomeArchiveId,
            ]);

            $posOrder->save();

            // Generate order number
            // ########### order number => order id + current date(YYYYMMDD + HH)
            $currentDate = date('YmdH', strtotime($posOrder->created_at) );
            $orderNumber = ($posOrder->id . $currentDate);
            $posOrder->order_number = $orderNumber;
            $posOrder->save();

            // save order details based on order id
            $orderQtns = json_decode($request['productVariantOrderQtnArr']);
            foreach($productVariants as $key => $productVariant){
                $posOrderDetail = new PosOrderDetail([
                    'pv_id'          => $productVariant->id,
                    'pv_sku'         => $productVariant->name,
                    'unit_price'     => $productVariant->price,
                    'order_quantity' => $orderQtns[$key],
                    'order_id'       => $posOrder->id,
                ]);
                $posOrderDetail->save();
            }

        } catch(QueryException $queryEx) {
            DB::rollBack();
            if($queryEx->errorInfo[1] == 1062) {
                $message = 'Duplicate order number detected, unable to process order, please contact us to fix the bugs!';
            } else {
                $message = 'Problem occured while trying to process order, please contact us to fix the bugs!';
            }
            return back()->with('error', $message);
        }

        DB::commit();
        return redirect()->route('order-receipt', ['orderId' => $posOrder->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the order detail resource.
     * @param  int  $orderId
     * @return \Illuminate\Http\Response
     */
    public function showReceipt($orderId)
    {
        // get pos order record
        $posOrder = PosOrder::getPosOrder($orderId);
        if(!$posOrder->data){
            return view('pos/index')
                ->with('error', 'Unable to generate receipt, order record not found!');
        }
        $posOrder = $posOrder->data;
        $orderDetails = $posOrder->orderDetails;

        return view( 'pos/receipt', compact('posOrder', 'orderDetails') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
