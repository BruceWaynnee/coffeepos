@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Customer Add')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/customer.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Customer Add --}}
<div class="add-customer-content-wrapper">
    <form id="customer-form" action="{{ url('dashboard/customers/create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- general informations --}}
        <div class="general-info-wrapper">
            <p class="font-weight-bold">General Informations</p>
            <hr>
            <div class="form-row"> {{-- name --}}
                {{-- name --}}
                <div class="form-group col-md-4">
                    <label for="name">Customer Name (*)</label>
                    <input class="form-control" type="text" name="name" id="name" minlength="2" maxlength="30" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="name accept only alphanumeric with whitespace" > [ Customer Name ? ]</small>
                </div>
            </div>
            <div class="form-row"> {{-- discount --}}
                {{-- discount --}}
                <div class="form-group col-md-4">
                    <label for="discount">Discount % (*)</label>
                    <input class="form-control" type="number" step="any" min="0" name="discount" id="discount" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="accept value from 0% -> 100%" > [ Discount ? ]</small>
                </div>
            </div>
            <div class="form-row"> {{-- contact, eail --}}
                {{-- contact --}}
                <div class="form-group col-md-4">
                    <label for="contact">Customer Contact (*)</label>
                    <input class="form-control" type="text" maxlength="10" name="contact" id="contact" required>
                </div>
                {{-- email --}}
                <div class="form-group col-md-4">
                    <label for="email">Customer Email</label>
                    <input class="form-control" type="email" name="email" id="email" minlength="6" maxlength="30">
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="Email format (xx.xx-xx@xxx.xx)" > [ Email ? ]</small>
                </div>
            </div>
        </div>
        {{-- add & reset button --}}
        <div class="customer-btn-wrapper form-row">
            <input type="submit" class="btn btn-sm btn-outline-info mr-2" value="Create Customer">
            <button id="customer-reset-btn" class="btn btn-sm btn-outline-danger cursor-pointer">Reset Fields</button>
        </div>
    </form>
</div>
{{-- END:: Customer Add --}}
@endsection

{{-- customer script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/customer.js') }}"></script>
    <script>
        $(document).ready(function(){
            validAddnEditCustomer();
        });
    </script>
@endsection