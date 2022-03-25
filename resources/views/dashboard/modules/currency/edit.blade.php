@extends('dashboard.layout.app')

<!-- page title -->
@section('dashboard_page_title', 'Currency Edit')

<!-- custom stylesheet -->
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/currency.css') }}">
@endsection

<!-- breadcrumb links -->
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard / </a>
        <a href="{{ route('currency-list') }}" class="breadcrumb-link">Currency</a>
    </li>
@endsection

@section('content')
<!-- BEGIN:: Currency Edit -->
<div class="edit-currency-content-wrapper">
    <form id="currency-form" action="{{ route('currency-update', ['id' => $currency->id]) }}" method="POST" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <!-- general information -->
        <div class="general-info-wrapper">
            <p class="font-weight-bold">General Information</p>
            <hr>
            <div class="form-row">
                <!-- name -->
                <div class="form-group col-md-4">
                    <label for="name">Currency Name</label>
                    <input class="form-control" type="text" value="{{ $currency->name }}" name="name" id="name" minlength="2" maxlength="20" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="name accept only alphanumeric and whitespace only" > [ Currency Name ? ]</small>
                </div>
                <div class="form-group col-md-8"></div>
                <!-- code -->
                <div class="form-group col-md-4">
                    <label for="code">Currency Code</label>
                    <input class="form-control" type="text" value="{{ $currency->code }}" name="code" id="code" minlength="2" maxlength="20" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="code accept only alphanumeric and '-' symbols only" > [ Currency Code? ]</small>
                </div>
                <!-- exchange rate -->
                <div class="form-group col-md-4">
                    <label for="code">Exchange Rate ({{ strtoupper( $currency->symbol ) }}) </label>
                    <input class="form-control" type="number" step="any" value="{{ $currency->exchange_rate }}" name="exchange_rate" id="exchange_rate" min="0.01" max="99999999" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="accept in the range from [ 0.01 to 99999999 ]" > [ Exchange Rate? ]</small>
                </div>                
            </div>
            <!-- update & cancel button -->
            <div class="currency-btn-wrapper form-row">
                <input type="submit" class="btn btn-sm btn-outline-success mr-2" value="Update">
                <a class="btn btn-sm btn-outline-danger" href="{{ route('currency-list') }}">Cancel</a>
            </div>
        </div>
        <!--  -->
    </form>
</div>
<!-- END:: Currency Edit -->
@endsection

<!-- custom script -->
@section('script')
    <script src="{{ asset('js/dashboard/modules/currency.js') }}"></script>
    <script>
        $(document).ready(function(){
            validAddnEditCurrency();

        });
    </script>
@endsection

