@extends('pos.layout.app')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/pos/order_receipt.css') }}">
@endsection

{{-- BEGIN::Receipt --}}
@section('content')
    {{-- back links --}}
    <div class="col-12 mt-1 text-right">
        <a href="{{ route('pos-home') }}" class="btn btn-sm btn-outline-success">Print Receipt And Return</a>
    </div>
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
                    <p>Order No: <small style="margin-left: .2em;">{{ ucwords($posOrder->order_number) }}</small></p>
                    <p>Date:     <small style="margin-left: 2.3em;">{{ date('d/m/Y', strtotime($posOrder->created_at)) }}</small></p>
                    <p>Customer: <small style="margin-left: 0em;">{{ ucwords($posOrder->customer) }}</small></p>
                    <p>Cashier:  <small style="margin-left: 1em;">{{ ucwords($posOrder->cashier) }}</small></p>
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
                        <p style="margin-bottom: 0;">Total <small style="font-size: 14px; font-weight: bold; margin-left: 1.2em;">$ {{ $posOrder->grand_total }} </small> </p> 
                    </div>
                </div>
                <div class="pv-order-list-row order-list-header">
                    <div style="flex: 0 1 50%;" class="order-list-col"> 
                        <p style="margin-bottom: 0;">Recieve $ {{ $posOrder->payment_receive }}</p> 
                    </div>
                </div>
                <div class="pv-order-list-row order-list-header">
                    <div style="flex: 0 1 50%;" class="order-list-col"> 
                        <p style="margin-bottom: 0;">Change $ {{ $posOrder->payment_return }}</p> 
                    </div>
                </div>
            </div>
            {{-- <p style="margin: 1em 0 0 -3em; text-align: center;">--------------------------------</p> --}}
        </div>
        {{-- receipt footer --}}
        <div class="receipt-footer-wrapper">
            <div class="waiting-wrapper">
                <p>Waiting Number</p>
                <p>{{ $posOrder->id }}</p>
            </div>
            <div class="contact-info-wrapper">
                <p>Developed by Satya IT Solution</p>
                <p>Tel 0969859559</p>
            </div>
        </div>
    </div>
@endsection
{{-- END::Receipt --}}

{{-- custom script --}}
@section('script')
    <script>
        $(document).ready(function(){

        });
    </script>
@endsection
