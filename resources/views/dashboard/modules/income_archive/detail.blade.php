@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Income Tracking Detail')

{{-- custom stylesheet --}}
@section('stylesheet')
<link rel="stylesheet" href="{{ asset('css/dashboard/modules/income_archive.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard</a>
    </li>
@endsection

@section('content')
{{-- back to list btn --}}
<div class="product-btn-wrapper form-row justify-content-end">
    <a class="btn btn-sm btn-outline-danger" href="{{ route('income-archive-list') }}">Back To List</a>
</div>
{{-- BEGIN:: Income Archive Detail --}}
<div class="income-archive-detail-wrapper mt-2">
    {{-- header block --}}
    <div class="detail-header-wrapper">
        <h3 class="mb-5">INCOME STATEMENT</h3>
        <div class="custom-detail-row"> {{-- system opening date --}} 
            <div class="custom-detail-column custom-font-weight">
                <p>System Opening Date</p>
            </div>
            <div class="custom-detail-column" style="margin-left: 2em;">
                <p>: {{ $incomeArchive->start_date }}</p>
            </div>
        </div>
        <div class="custom-detail-row"> {{-- system closing date --}} 
            <div class="custom-detail-column custom-font-weight">
                <p>System Closing Date</p>
            </div>
            <div class="custom-detail-column" style="margin-left: 2.6em;">
                <p>: {{ $incomeArchive->end_date }}</p>
            </div>
        </div>
        <div class="custom-detail-row"> {{-- system operator --}} 
            <div class="custom-detail-column custom-font-weight">
                <p>System Operator</p>
            </div>
            <div class="custom-detail-column" style="margin-left: 4.4em;">
                <p>: {{ ucwords($incomeArchive->staff) }}</p>
            </div>
        </div>

    </div>
    {{-- body block --}}
    <div class="detail-body-wrapper">
        <div class="custom-detail-row align-items-center mb-4"> {{-- revenue --}} 
            <div class="custom-detail-column">
                <div class="detail-icon-wrapper">
                    <img src="{{ asset('img/dashboard/icons/revenue.png') }}" alt="revenu-logo">
                </div>
            </div>
            <div class="custom-detail-column" style="margin-left: 2em;">
                <p class="custom-font-weight">Revenue : <small class="custom-detail-small-tage-font-size">{{ $incomeArchive->total_revenue }}</small> $</p>
                <p>money a business actually receives during a specific period</p>
            </div>
        </div>
        <div class="custom-detail-row align-items-center mb-4"> {{-- expense --}} 
            <div class="custom-detail-column">
                <div class="detail-icon-wrapper">
                    <img src="{{ asset('img/dashboard/icons/expenses.png') }}" alt="expense-logo">
                </div>
            </div>
            <div class="custom-detail-column" style="margin-left: 2em;">
                <p class="custom-font-weight">Expense : <small class="custom-detail-small-tage-font-size">{{ $incomeArchive->total_expense }}</small> $</p>
                <p>expense of stand by money that change back to customers after making payment</p>
            </div>
        </div>
        <div class="custom-detail-row align-items-center"> {{-- net income --}} 
            <div class="custom-detail-column">
                <div class="detail-icon-wrapper">
                    <img src="{{ asset('img/dashboard/icons/net_income.png') }}" alt="net-income-logo">
                </div>
            </div>
            <div class="custom-detail-column" style="margin-left: 2em;">
                <p class="custom-font-weight">Net Income : <small class="custom-detail-small-tage-font-size">{{ $incomeArchive->total_net_income }}</small> $</p>
                <p>profit money after expense deducted</p>
            </div>
        </div>

    </div>
    {{-- footer block --}}
    <div class="detail-footer-wrapper">
        {{-- total orders made --}}
        <div class="total-order-made-wrapper">
            <div class="custom-detail-row"> {{-- total order made --}} 
                <div class="custom-detail-column custom-font-weight">
                    <p>Total Order Made :</p>
                </div>
                <div class="custom-detail-column" style="margin-left: 1em;">
                    <p>{{ $incomeArchive->total_order_made }} Orders</p>
                </div>
            </div>
            <div class="custom-detail-row"> {{-- order number --}} 
                <div class="custom-detail-column custom-font-weight">
                    <p>Order Number :</p>
                </div>
                <div class="custom-detail-column" style="margin-left: 2.5em;">
                    @foreach ($incomeArchive->orderNumbers as $orderNumbers)
                        <p>{{ $orderNumbers }}</p>
                    @endforeach
                </div>
            </div>

        </div>
        {{-- order product variants table --}}
        <div class="order-pv-table-wrapper">
            <p class="font-weight-bolder">Ordered Products</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Variant Name</th>
                        <th>Order Quantities</th>
                        <th>Unit Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderPvArrs as $orderPv)
                    <tr>
                        <td>{{ ucwords($orderPv['pvName']) }}</td>
                        <td>{{ $orderPv['orderQty'] }}</td>
                        <td>{{ $orderPv['unitPrice'] }} $</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- END:: Income Archive Detail --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/income_archive.js') }}"></script>
    <script>
        $(document).ready(function(){
            validListIncomeArchive();
        });
    </script>    
@endsection
