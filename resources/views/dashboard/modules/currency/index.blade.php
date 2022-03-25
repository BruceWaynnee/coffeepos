@extends('dashboard.layout.app')

<!-- page title -->
@section('dashboard_page_title', 'Currency List')

<!-- custom stylesheet -->
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/currency.css') }}">
@endsection

<!-- breadcrumb links -->
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard</a>
    </li>
@endsection

@section('content')
<!-- BEGIN:: Currency -->
<div class="currency-content-wrapper">
    <table class="table currency-table-listing-wrapper">
        {{-- table head --}}
        <thead>
            <tr>
                <th>Currency N°</th>
                <th>Currency Name</th>
                <th>Currency Code</th>
                <th>Symbol</th>
                <th>Exchange Rate</th>
                <th>Date Creation</th>
                <th>Action</th>
            </tr>
        </thead>
        {{-- table body --}}
        <tbody>
            @foreach ($currencies as $key => $currency)                        
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ ucwords( $currency->name ) }}</td>
                <td>{{ $currency->code }}</td>
                <td>{{ ucwords( $currency->symbol ) }}</td>
                <td>{{ $currency->exchange_rate }}</td>
                <td>{{ $currency->created_at }}</td>
                {{-- action dropdown menu --}}
                <td>
                    <img type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="{{ asset('img/dashboard/logo/action.png') }}" alt="action icon">
                    {{-- dropdown items --}}
                    <div class="dropdown-menu dropdown-menu-left">
                        {{-- edit --}}
                        @can('edit currency')
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="{{url("dashboard/currencies/$currency->id/edit")}}">Edit</a>
                        </div>
                        @endcan
                        {{-- delete --}}
                        {{-- @can('delete currency')
                        <div class="action-delete-wrapper">
                            <form action="{{ route('currency-delete', ['id' => $currency->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="currency-delete-btn dropdown-item">
                                    Delete
                                </button>
                            </form>
                        </div>
                        @endcan --}}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- END:: Currency -->
@endsection

<!-- custom script -->
@section('script')
    <script src="{{ asset('js/dashboard/modules/currency.js') }}"></script>
    <script>
        $(document).ready(function(){
            validListCurrency();
        });
    </script>
@endsection

