@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Order List')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/order.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Order --}}
<div class="order-content-wrapper">
    <table class="table order-table-listing-wrapper">
        {{-- table head --}}
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Customer</th>
                <th>Grand Total</th>
                <th>Payment Receive</th>
                <th>Payment Return</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>
        </thead>
        {{-- table body --}}
        <tbody>
            @foreach ($orders as $key => $order)                        
            <tr>
                <td>{{ $order->order_number }}</td>
                <td>{{ ucwords($order->customer->name) }}</td>
                <td>$ {{ $order->grand_total }}</td>
                <td>$ {{ $order->payment_receive }}</td>
                <td>$ {{ $order->payment_return }}</td>
                <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                {{-- action dropdown menu --}}
                <td>
                    <img type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="{{ asset('img/dashboard/logo/action.png') }}" alt="action icon">
                    {{-- dropdown items --}}
                    <div class="dropdown-menu dropdown-menu-left">
                        {{-- detail --}}
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="{{ route('order-detail', ['id' => $order->id]) }}">Detail</a>
                        </div>
                        {{-- delete --}}
                        <div class="action-delete-wrapper">
                            <form action="{{ route('order-delete', ['id' => $order->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="order-delete-btn dropdown-item">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- END:: Order --}}
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
