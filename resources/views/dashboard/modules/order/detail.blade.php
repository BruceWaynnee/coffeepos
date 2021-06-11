@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Order Detail')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/pos/order_receipt.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/order.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard</a>
    </li>
@endsection

@section('content')
{{-- back to list btn --}}
<div class="product-btn-wrapper form-row">
    <a class="btn btn-sm btn-outline-danger" href="{{ route('order-list') }}">Back To List</a>
</div>
{{-- BEGIN:: Order Detail --}}
<div class="order-content-wrapper">
    {{-- receipt block --}}
    <div class="order-receipt-wrapper">
        {{-- receipt header --}}
        <div class="receipt-header-wrapper">
            {{-- logo --}}
            <div class="header-logo-wrapper">
                <img src="{{ asset('img/dashboard/logo/coffee_logo.png') }}" alt="pos logo">
            </div>
            {{-- header details --}}
            <div class="header-detail-wrapper">
                <p>RECEIPT</p>
                <p>Tel: 0969859559</p>
                <div class="order-header-info">
                    <p>Order No: <small style="margin-left: .2em;">{{ ucwords($order->order_number) }}</small></p>
                    <p>Date:     <small style="margin-left: 2.3em;">{{ date('d/m/Y', strtotime($order->created_at)) }}</small></p>
                    <p>Customer: <small style="margin-left: 0em;">{{ ucwords($order->customer) }}</small></p>
                    <p>Cashier:  <small style="margin-left: 1em;">{{ ucwords($order->cashier) }}</small></p>
                </div>
                <p style="margin: 1em 0 1em 0;">--------------------------------</p>
            </div>
        </div>
        {{-- receipt body --}}
        <div class="receipt-body-wrapper">
            {{-- order productvariant list --}}
            <div class="pv-order-list-wrapper">
                {{-- heading --}}
                <div class="pv-order-list-row order-list-header">
                    <div style="flex: 0 1 10%;" class="order-list-col"> <p>No</p> </div>
                    <div style="flex: 0 1 40%;" class="order-list-col"> <p>Description</p> </div>
                    <div style="flex: 0 1 10%;" class="order-list-col"> <p>Qty</p> </div>
                    <div style="flex: 0 1 40%;" class="order-list-col"> <p>Price</p> </div>
                </div>
                {{-- list body --}}
                @foreach ($orderDetails as $key => $orderDetail)
                    <div class="pv-order-list-row order-list-body">
                        <div style="flex: 0 1 10%;" class="order-list-col"> <p>{{ $key+1 }}</p> </div>
                        <div style="flex: 0 1 40%;" class="order-list-col"> <p>{{ ucwords($orderDetail->pv_sku) }}</p> </div>
                        <div style="flex: 0 1 10%;" class="order-list-col"> <p>{{ $orderDetail->order_quantity }}</p> </div>
                        <div style="flex: 0 1 40%;" class="order-list-col"> <p>$ {{ $orderDetail->unit_price }}</p> </div>
                    </div>
                @endforeach
            </div>
            <p style="margin: 1em 0 1em -3em; text-align: center;">--------------------------------</p>
            {{-- total info --}}
            <div class="total-info-wrapper">
                <div class="pv-order-list-row order-list-header">
                    <div style="flex: 0 1 50%;" class="order-list-col"> 
                        <p style="margin-bottom: 0;">Total <small style="font-size: 14px; font-weight: bold; margin-left: 1.2em;">$ {{ $order->grand_total }} </small> </p> 
                    </div>
                </div>
                <div class="pv-order-list-row order-list-header">
                    <div style="flex: 0 1 50%;" class="order-list-col"> 
                        <p style="margin-bottom: 0;">Recieve $ {{ $order->payment_receive }}</p> 
                    </div>
                </div>
                <div class="pv-order-list-row order-list-header">
                    <div style="flex: 0 1 50%;" class="order-list-col"> 
                        <p style="margin-bottom: 0;">Change $ {{ $order->payment_return }}</p> 
                    </div>
                </div>
            </div>
            {{-- <p style="margin: 1em 0 0 -3em; text-align: center;">--------------------------------</p> --}}
        </div>
        {{-- receipt footer --}}
        <div class="receipt-footer-wrapper">
            <div class="waiting-wrapper">
                <p>Waiting Number</p>
                <p>{{ $order->id }}</p>
            </div>
            <div class="contact-info-wrapper">
                <p>Developed by Satya IT Solution</p>
                <p>Tel 0969859559</p>
            </div>
        </div>
    </div>
</div>
{{-- END:: Order Detail --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/order.js') }}"></script>
    <script>
        $(document).ready(function(){
            validListOrder();
        });
    </script>    
@endsection
